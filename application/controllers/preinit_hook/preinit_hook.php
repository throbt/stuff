<?php

class getPreinit_hook {
	static function &get($scope = '') {
		static $obj;
		if (!is_object($obj)){
			$obj = new Preinit_hook($scope);
		}
		return $obj;
	}
}

class Preinit_hook {

  function __construct($scope) {
  	$this->scope = $scope;
  	$this->init();
  }

  public function init() {
  	$this->scope->session->setLanguage($this->scope->params->get);
  }
}