<?php

class Home extends Controller {
  
  public function index() {
    $this->router->content = $this->router->renderTemplate('bla', 'home');
  }
}
