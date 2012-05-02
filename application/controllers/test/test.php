<?php

class Test extends Controller {
	public function init() {
		echo 'this is the controller init' . "<br />";
	}
	
	public function index() {
		echo 'index';
	}
	
	public function show() {
		echo "show:  id={$this->router->params->index}";
	}
	
	public function thisTest() {
		echo 'thisTest';
	}
}