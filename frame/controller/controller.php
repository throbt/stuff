<?php

class Controller {
  function __construct($scope) {
    $this->router = $scope;
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
