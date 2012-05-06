<?php

class Controller {
  function __construct($scope) {
    global $loader;
    $this->router     = $scope;
		$this->loader     = $loader;
		$this->post       = $this->router->params->post;
		$this->get        = $this->router->params->get;
		$this->index 	    = isset($this->router->params->index) ? $this->router->params->index : null;
    $this->view       = $this->loader->get('View');
    $this->htmlRender = true;
    $this->tpl        = '';
    $this->variable   = '';
    $this->init();
  }
  
  public function init() {
  }

  public function render() {
    if($this->htmlRender) {
      if($this->tpl == '') {
        $this->tpl = $this->view->getTemplatePath($this->router->scope,$this->router->method);
        echo $this->view->renderTemplate(($this->variable != '' ? $this->variable : ''),$this->tpl);
      }
    }
  }

	/*
		goTo is reserved in php 5.3
	*/
	public function goToRoute($nextRoute = '') {
		$route = ($nextRoute != '' ? $nextRoute : 'home');
		header("location: /{$route}");
	}
}
