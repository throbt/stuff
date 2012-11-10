<?php

class Test_controller extends Controller {
	
  public function init() {
    global $session;
    $this->session  = $session;
    $this->model    = $this->router->loader->get('Node');
  }
  
  public function index() {
    $this->title    = 'boxes';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => ''
      ),
      $this->view->getTemplatePath('test','index')
    );
    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','test')
    );
  }
  
  public function show() {
    echo "Home/show";
  }
}