<?php

class Test_helper extends View {

  public function init() {
    global $loader;
    $this->loader = $loader;
    $this->model  = $this->loader->get('Node');
  }

  public function getSiderMenu($nodes,$scope='',$current='') {
    if($scope != '') {
      return $this->renderTemplate(array(
        'scope'   => $this,
        'route'   => $scope,
        'current' => $current,
        'nodes'   => $nodes
      ),$this->getTemplatePath('page','sidermenu'));
    }
    return false;
  }

  public function getMenu($job='') {
    $menuItems = array(
      
    );
    if($job=='data')
      return $menuItems;

    return $this->renderTemplate($menuItems,$this->getTemplatePath('page','menu'));
  }

  public function getRoute() {
    return $this->scope->router->scope;
  }

  public function getSEO() {
    $metas  = '';
    $names = array(
      'format-detection'  => 'telephone=no',
      'viewport'          => 'width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1',
      'apple-mobile-web-app-capable' => 'yes',
      'apple-mobile-web-app-status-bar-style' => 'black'
    );
    $httpequivs = array(
      'Content-type'      => 'text/html; charset=utf-8',
      'X-UA-Compatible'   => 'IE=edge,chrome=1',
      'Copyright'         => 'M N V C',
      'author'            => 'thRobt'
    );
    
    foreach($httpequivs as $key => $value) {
        $metas .= implode('',array(
          "<meta http-equiv='",
          $key,
          "' content='",
          $value,
          "' />\n"
        ));
    }
    foreach($names as $key => $value) {
        $metas .= implode('',array(
          "<meta name='",
          $key,
          "' content='",
          $value,
          "' />\n"
        ));
    }
    return $metas;
  }

  public function getTitle($title) {
    return "<title>{$title}</title>";
  }

  public function getPageHeader() {
    return $this->renderTemplate(
      array(
        'scope' => $this->scope,
        'data'  => ''
      ),
      $this->getTemplatePath('page','page_header')
    );
  }

  public function getPageFooter() {
    return $this->renderTemplate(
      array(
        'scope' => $this->scope,
        'data'  => $this->getMenu('data')
      ),
      $this->getTemplatePath('page','page_footer')
    );
  }

  public function getHeader() {
  	return implode("\n",array(
      $this->getTitle((!isset($this->scope->title) ? '' : $this->scope->title)),
      $this->getSEO(),
      $this->getStyle(),
      $this->getScript()
    ));
  }

  public function getStyle() {
    
    $thisRoute = $this->getRoute();

    $arr = array(
      /*'http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,latin-ext',
      'http://fonts.googleapis.com/css?family=Fenix|Source+Code+Pro|Archivo+Black',
      'http://fonts.googleapis.com/css?family=Archivo+Black',*/
      
      BOOTSTRAP . 'css/bootstrap.css',
      BOOTSTRAP . 'css/bootstrap-responsive.css',
      
      // BOOTSTRAP . 'css/docs.css',
      // JQUERY_UI_BOOTSTRAP . 'css/custom-theme/jquery-ui-1.8.16.custom.css',
      // JQUERY_UI_BOOTSTRAP . 'css/custom-theme/jquery.ui.1.8.16.ie.css',
      // '/css/style.css'

      MNVC      . 'build/mnvc.css',
    );

    /*if($thisRoute == 'order') {
      $arr[] = '/css/form.css';
    }*/

    $styles   = '';
    foreach($arr as $scriptName) {
      $styles .= implode('',array(
        "<link rel='stylesheet' type='text/css' href='",
        $scriptName,
        "' />\n"
      ));
    }
    return $styles;
  }

  public function getScript() {

    $thisRoute = $this->getRoute();

    $arr = array(
      LIB                 . 'jquery-1.8.2.min.js',
      // JQUERY_UI_BOOTSTRAP . 'js/jquery-ui-1.8.16.custom.min.js',
      EMILE               . 'emile.js',
      BOOTSTRAP           . 'js/bootstrap.js',

      // MNVC                . 'lib/builder.js',
      // MNVC                . 'lib/stuff.js',
      // MNVC                . 'lib/effect.js',
      // MNVC                . 'lib/component.js',
      // MNVC                . 'lib/initializer.js',

      MNVC                . 'build/mnvc.js',

      '/js/draggable.js'
    );
    if($thisRoute == 'order') {
      $arr[] = '/js/form.js';
    }
    $scripts  = '';
    foreach($arr as $scriptName) {
      $scripts .= implode('',array(
        "<script src='",
        $scriptName,
        "' type='text/javascript'></script>\n"
      ));
    }
    return $scripts;
  }
}
