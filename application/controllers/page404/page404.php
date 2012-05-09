<?php

class page404_controller extends Controller {
	
  public function init() {
    $this->index();
  }
  
  public function index() {
    echo '404';
  }
}