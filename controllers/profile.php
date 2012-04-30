<?php

class Profile extends Controller {
  
  public function init() {
    $this->user           = $this->router->loader->get('User','model');  //users_domains
    $this->users_domains  = $this->router->loader->get('Usersdomain','model');
  }
  
  public function index() {
    $this->router->nextRoute = 'home';
    $this->router->goToRoute();
  }
  
  public function show($id) {
  
    /*
      model access, at now we dont have time to manage this stuff nicer..
      TODO: must refact! need an Access class (read|write|global|personal|no)
      
      the owner cant access another profiles
    */
    if($_SESSION['sessionUser']->role_id == 3) {
      if($id != $_SESSION['sessionUser']->id) {
        $this->router->nextRoute = "profile/{$_SESSION['sessionUser']->id}";
        $this->router->goToRoute();
      }
    }
    
    $thisProfile = $this->user->getById($id);
    
    if($thisProfile) {
      $this->router->session->setToken();
      $template       = ($_SESSION['sessionUser']->role_id == 1000 ? 'newpassword' : 'profile');
      $profileContent = $this->router->renderTemplate(/*$_SESSION['sessionUser']*/ $thisProfile, $template);
      
      $adminContent               = $this->router->renderTemplate(array(
        'domains'     => $this->users_domains->get($thisProfile->id),
        'addDomains'  => $this->users_domains->getDomains($thisProfile->id)
      ), 'profileadmin');
      
      $this->router->content = $profileContent . $adminContent;
      
      $this->router->title = 'profil';
      $this->router->render();
    } else {
      $this->router->nextRoute = 'home';
      $this->router->goToRoute();
    }
  }
  
  public function newpass() {
    $this->user->changePassword($_POST['password'],$_POST['id']);
    $this->router->nextRoute = "profile/{$_POST['id']}";
    $this->router->goToRoute();
  }
  
  public function add() {
    if($_POST['password'] != '') {
      $thisProfile  = $this->user->getById($_POST['id']);
      $thisPassword = md5($_POST['password']);
      if($thisPassword == $thisProfile->password) {
        $this->router->nextRoute = "profile/{$_POST['id']}";
        $this->router->goToRoute();
      } else {
        $this->user->changePassword($_POST['password'],$_POST['id']);
        
        $this->usersroles = $this->router->loader->get('Usersroles','model');
        $this->usersroles->updateRole(3,$_POST['id']);
        
        $this->router->nextRoute = "login/logout";
        $this->router->goToRoute();
      }
    } else {
      $this->router->nextRoute = "profile/{$_POST['id']}";
      $this->router->goToRoute();
    }
  }
}
