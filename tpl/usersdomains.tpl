<?php

class Usersdomains extends Controller {

  public function init() {
    $this->users_domains  = $this->router->loader->get('Usersdomain','model');
  }
  
  public function index() {
    $this->router->content = $this->router->renderTemplate('Usersdomains', 'usersdomains');
  }
  
  public function add() { print_r($_POST);
#    $this->users_domains->add($_POST['deleteId']);
  }
  
  public function delete() {
    $this->users_domains->delete($_POST['deleteId']);
    $this->router->nextRoute = "profile/{$_POST['profileId']}";
    $this->router->goToRoute();
  }
}
