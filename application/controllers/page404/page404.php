<?php

class page404 extends Controller {
	
	public function init() {
		$this->index();
	}
	
	public function index() {
		echo '404';
	}
}