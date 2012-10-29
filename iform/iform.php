<?php

class Iform_controller extends Controller {
	public function init() {
    global $session,$loader;
    $this->session 	= $session;
    $this->loader 	= $loader;
    $this->action   = (isset($this->router->orders[1]) ? $this->router->orders[1] : '');
  }

  public function router() {
    if($this->action == '') {
      $this->action = 'index';
    }
  	if(method_exists($this, $this->action)) {
      $action = $this->action;
      $this->$action();
    }
  }

  public function index() {
    echo "index";
  }

  public function test() {
    echo "testt";
  }
}