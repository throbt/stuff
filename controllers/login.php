<?php

class Login {

  function __construct($scope) {
    $this->router = $scope;
  }
  
  public function index() {
    $this->router->render  = 'true';
    $this->router->tpl     = 'login';
    $this->router->render();
  }
  
  public function logout() {
    session_destroy();
    session_unset();
    $this->sendBack();
  }
  
  public function process() {
    $this->session = getSession::get();
    if(!$this->session->checkToken($_POST['token'])) {
      $this->sendBack();
    }
    
    $this->user = $this->router->loader->get('User','model');
    $user       = $this->user->getByForm($_POST['user'],$_POST['password']);
    
    if($user) {
      $_SESSION['sessionUser'] = new stdClass();
      foreach($user as $k => $v) {
        $_SESSION['sessionUser']->$k = $v;
      }
      $_SESSION['sessionUser']->lastCheck = time();
      
      $this->router->nextRoute = 'home';
      $this->router->goTo();
      die();
    } else {
      $this->sendBack();
    }
  }
  
  /*
    ez megy a controllerbe, TODO refact!
  */
  public function sendBack() {
    $this->router->nextRoute = 'login';
    $this->router->goTo();
    die();
  }
}
