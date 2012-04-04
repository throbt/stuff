<?php

class Routeaccess extends Controller {
  
  public function index() {
    $this->router->content = $this->router->renderTemplate('routeaccess', 'routeaccess');
  }
}
