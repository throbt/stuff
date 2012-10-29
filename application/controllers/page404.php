<?php

class page404_controller extends Controller {
	
  public function init() {
    global $session; global $loader;
    $this->session    = $session;
    $this->loader     = $loader;
    $this->nodeModel  = $this->loader->get('Node');
  }
  
  public function index() {
    $this->title    = '404';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope'   => $this->router,
        'nodes'   => ''
      ),
      $this->view->getTemplatePath('page','page404')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }
}