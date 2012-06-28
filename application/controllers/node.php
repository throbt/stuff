<?php

class Node_controller extends Nodecontroller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Node');
    $this->itemPerPage  = 10;
  }

  public function index() {
    $this->redirect("admin_content");
  }

}