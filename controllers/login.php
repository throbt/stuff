<?php

class Login {

  function __construct($scope) {
    $this->router = $scope;
  }
  
  public function index() {
#    session_destroy();
#    session_unset();
#    unset($_SESSION['sessionUser']);
    if(isset($_SESSION['sessionUser'])) {
      $this->router->nextRoute = 'domainss';
      $this->router->goToRoute();
    } else {
      $this->router->session->setToken();
      $this->router->tpl     = 'login';
      $this->router->title   = 'bejelentkezés';
      $this->router->render();
    }
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
      
      $this->router->nextRoute = 'domainss';
      $this->router->goToRoute();
      die();
    } else {
      $this->sendBack();
    }
  }
  
  /*
    ez megy a controllerbe, TODO refact!
  */
  public function sendBack() {
    $this->router->nextRoute = '';
    $this->router->goToRoute();
    die();
  }
}
