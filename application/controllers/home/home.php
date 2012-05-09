<?php

class Home_controller extends Controller {
	
  public function init() {
    // $this->model = $this->router->loader->get('Home','model');
  }
  
  public function index() {
    $this->title    = 'Manna';
		$this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => 'valami'
      ),
      $this->view->getTemplatePath('home','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }
  
  public function show() {
		//echo "show:  id={$this->router->params->index}";  
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