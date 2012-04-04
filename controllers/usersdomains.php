<?php

class Usersdomains extends Controller {
  
  public function index() {
    $this->router->content = $this->router->renderTemplate('Usersdomains', 'usersdomains');
  }
}
