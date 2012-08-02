<?php

class Taxonomycontroller extends Controller {

  public function indexAction() {
    echo 'indexAction';
  }

  public function addVocabulary() {
    print_r($this->model);
  }
}
