<?php

class Profile extends Controller {
  
  public function init() {
    $this->user = $this->router->loader->get('User','model');
  }
  
  public function index() {
    $this->router->nextRoute = 'home';
    $this->router->goTo();
  }
  
  public function show($id) {
  
    /*
      model access, at now we dont have time to manage this stuff nicer..
      TODO: must refact! need an Access class (read|write|global|personal|not) 
    */
    if($_SESSION['sessionUser']->role_id == 3) {
      if($id != $_SESSION['sessionUser']->id) {
        $this->router->nextRoute = "profile/{$_SESSION['sessionUser']->id}";
        $this->router->goTo();
      }
    }
    
    $thisProfile = $this->user->getById($id);
    
    if($thisProfile) {
      $this->router->session->setToken();
      $template = ($thisProfile->role_id == 1000 ? 'newpassword' : 'profile');
      $this->router->content = $this->router->renderTemplate(/*$_SESSION['sessionUser']*/ $thisProfile, $template);
      $this->router->render();
    } else {
      $this->router->nextRoute = 'home';
      $this->router->goTo();
    }
  }
  
  public function newpass() {
    $this->user->changePassword(md5($_POST['password']),$_POST['id']);
    $this->router->nextRoute = "profile/{$_POST['id']}";
    $this->router->goTo();
  }
  
  public function add() {
    if($_POST['password'] != '') {
      $thisProfile  = $this->user->getById($_POST['id']);
      $thisPassword = md5($_POST['password']);
      if($thisPassword == $thisProfile['password']) {
        $this->router->nextRoute = "profile/{$_POST['id']}";
        $this->router->goTo();
      } else {
        $this->user->changePassword($thisPassword,$_POST['id']);
        
        $this->usersroles = $this->router->loader->get('Usersroles','model');
        $this->usersroles->updateRole(3,$_POST['id']);
        
        $this->router->nextRoute = "login/logout";
        $this->router->goTo();
      }
    } else {
      $this->router->nextRoute = "profile/{$_POST['id']}";
      $this->router->goTo();
    }
  }
}
