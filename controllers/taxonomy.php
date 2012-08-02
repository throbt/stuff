<?php

class Taxonomy_controller extends Taxonomycontroller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Taxonomy');
    $this->itemPerPage  = 20;
  }

  public function index() {
    $this->indexAction();
  }

  public function add() {
    $this->addVocabulary();
  }
}
