<?php

class getRouter {
  static public function &get($scope = '') {
    static $obj;
    if (!is_object($obj)){
      $obj = new Router($scope);
    }
    return $obj;
  }
}

class Router {
  function __construct($scope = '') {
    global $loader;
    $this->loader     = $loader;
    $this->session    = $this->loader->get('Session','class');
    $this->model      = $this->loader->get('Model','class');
    $this->controller = $this->loader->get('Controller','class',$this);
    $this->title      = '';
    $this->show       = true;
    $this->setRoute();
  }
  
  private function setRoute() {
    $this->setUrlParts();
    
    $this->static = array(
      'cegunkrol',
      'termsofuse',
      'about_us'
    );
    
    /*
      static pages
    */
    if($this->urlParts[0] == '') {
      $this->nextRoute = 'cegunkrol';
      $this->goToRoute();
      die();
    } else if(in_array($this->urlParts[0],$this->static)) {
      $this->thisController = $this->loader->get('Statically','controller',$this);
      die();
    }
    
    /*
      checking if its a simple request for auth (redirect loop by checkProfile is the reason)
    */
    if($this->urlParts[0] == 'login') {
      $login = $this->loader->get('Login','controller',$this);
      if(isset($this->urlParts[1]) && !method_exists($login,$this->urlParts[1])) {
        $this->nextRoute = 'login';
        $this->goToRoute();
      } else if(!isset($this->urlParts[1])) {
        $login->index();
      } else {
        $method = $this->urlParts[1];
        $login->$method();
      }
      
    /*
      routing
    */  
    } else {
      $this->checkProfile();
      $this->route  = $this->loader->get('Route','model');
      $routes       = $this->route->get($_SESSION['sessionUser']->role_id);
      $this->menu   = $routes[1];
      $this->title  = $this->getTitle($this->urlParts[0],$routes[1]);
      if(in_array($this->urlParts[0],$routes[0])) {
        $this->thisRoute      = $this->urlParts[0];
        $this->thisController = $this->loader->get($this->thisRoute,'controller',$this);
        if(isset($this->urlParts[1]) && !method_exists($this->thisController,$this->urlParts[1])) {
          if(is_numeric($this->urlParts[1])) {
            $this->thisController->show($this->urlParts[1]);
          } else {
            $this->nextRoute = $this->thisRoute;
            $this->goToRoute(); 
          }
        } else if(isset($this->urlParts[1]) && method_exists($this->thisController,$this->urlParts[1])) {
          $method = $this->urlParts[1];
          $this->thisController->$method();
        } else { 
          $this->thisController->index();
          if($this->show)
            $this->render();
        }
      } else {
        if($_SESSION['sessionUser']->role_id == 1000) {
          $this->nextRoute = "profile/{$_SESSION['sessionUser']->id}";
        } else {
          $this->nextRoute = ''; 
        }
        $this->goToRoute();
      }
    }
    
  }
  
  public function getTitle($route,$thisRoutes) {
    foreach($thisRoutes as $thisRoute) {
      if($thisRoute['route'] == $route)
        return $thisRoute['name'];
    }
  }
  
  /*
    we dont separate the view,
    only three methods we need:
      * renderTemplate
      * render
      * setTemplate
      
    a part of view 
  */
  public function renderTemplate($var, $template) {
    $this->var  = $var;
    $content    = '';
    
    ob_start();
    $this->setTemplate($template);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }
  
  public function setTemplate($template) {
    require_once(TPL.$template.'.tpl');
  }
  
  public function render() {
    $this->menu     = $this->urlParts[0] == 'login' ? '' : $this->renderTemplate($this->menu, 'menu');
    $this->content  = !isset($this->content)  ? $this->renderTemplate($this->session->setToken(), $this->tpl) : $this->content;
    $this->header   = !isset($this->header)   ? $this->renderTemplate('', 'header') : $this->header;
    $this->footer   = !isset($this->footer)   ? $this->renderTemplate('', 'footer') : $this->footer;
    $this->frame    = $this->renderTemplate(array(
      'content' => $this->content,
      'header'  => $this->header,
      'footer'  => $this->footer,
      'menu'    => $this->menu
    ), 'frame');
    
    echo $this->frame;
  }
  
  /*
    end of view
  */
  
  private function setUrlParts() {
    $arr            = explode('?',$_SERVER['REQUEST_URI']);
    $this->urlParts = array_slice(explode('/',$arr[0]),1);
  }
  
  public function getUrlParts() {
    return $this->urlParts;
  }
  
  public function checkProfile() {
    if(!$this->session->checkProfile()) {
      unset($_POST);
      unset($_GET);
      $this->nextRoute = 'login';
      $this->goToRoute();
      die();
    }
  }
  
  /*
    goTo is reserved in 5.3
  */
  public function goToRoute($nextRoute = '') {
    $route = ($nextRoute != '' ? $nextRoute : (isset($this->nextRoute) ? $this->nextRoute : 'home'));
    header("location: /{$route}");
  }
}