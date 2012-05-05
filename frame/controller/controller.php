<?php

class Controller {
  function __construct($scope) {
    $this->router = $scope;
		$this->loader = $this->router->loader;
		$this->post 	= $this->router->params->post;
		$this->get 		= $this->router->params->get;
		$this->index 	= isset($this->router->params->index) ? $this->router->params->index : null;
    $this->init();
  }
  
  public function init() {
  }

	/*
		goTo is reserved in php 5.3
	*/
	public function goToRoute($nextRoute = '') {
		$route = ($nextRoute != '' ? $nextRoute : 'home');
		header("location: /{$route}");
	}
}
