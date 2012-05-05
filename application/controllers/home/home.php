<?php

class Home_controller extends Controller {
	
  public function init() {
    // $this->model = $this->router->loader->get('Home','model');
  }
  
  public function index() {
		echo 'Home - index';
  }
  
  public function show() {
		echo "show:  id={$this->router->params->index}";  
  }
  
  public function thisTest() {
    echo 'thisTest';
  }

  public function create() {
    print_r($this->router->params);
		echo 'create';
  }

	public function update() {
    echo 'update';
  }
	
	public function delete() {
    echo 'delete';
  }
}