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
    $this->setController();
  }

  public function setController() {
    $Linx       = $this->scope->loader->get('Linx', 'model');
    $thisOrders = $Linx->getByOrder($this->scope->orders[0]);

    if(isset($thisOrders[0]['params'])) {
      $orders = array();
      $parts  = explode('/', $thisOrders[0]['params']);

      foreach ($parts as $part) {
        $orders[] = $part;
      }
      $this->scope->orders = $orders;
    }
  }
}