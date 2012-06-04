<?php

class Admin_controller extends Controller {
	
  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
    }
  }
  
  public function index() {
    $this->title    = 'Evoline - admin';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => 'hello'
      ),
      $this->view->getTemplatePath('admin','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
  
  public function show() {
		//echo "show:  id={$this->router->params->index}";  
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