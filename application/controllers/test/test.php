<?php

class Test_controller extends Controller {
  public function init() {
    //echo 'this is the controller init' . "<br />";
		
		// $ff = getLoader::get();
		
		// var_dump($this->router->loader);

		$this->model = $this->router->loader->get('Test','model');
  }
  
  public function index() {
	
		// print_r($this);
	
		// print_r($this);
	
    // echo '
    // 			<form action="/test" method="post">
    // 				<input type="hidden" name="_method" value="create" />
    // 				<input type="submit" value="Go" />
    // 			</form>
    // 		';
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