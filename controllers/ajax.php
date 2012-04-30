<?php

class Ajax extends Controller {

  public function init() {
    $this->router->show     = false;
    $this->ajax             = $this->router->loader->get('Ajaxmethods','class');
  }
  
  public function index() {
    if($_POST['token'] == $_SESSION['token']) {
      if(isset($_POST['method'])) {
        if(method_exists($this->ajax,$_POST['method'])) {
          $method = $_POST['method'];
          $this->ajax->$method($this);
        }
      }
    } else {
      die('false');
    }
  }
}
