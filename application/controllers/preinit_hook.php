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
    /*
      langueage
    */
  	$this->scope->session->setLanguage($this->scope->params->get);
    /*
      seo urls
    */
    //$this->setOrders();
  }

  public function setOrders() {
    $Linx       = $this->scope->loader->get('Linx', 'model');
    $thisOrders = $Linx->getByOrder(urldecode($this->scope->orders[0]));

    if(isset($thisOrders[0]['params'])) {
      $orders   = array();
      $urlParts = explode('?', $thisOrders[0]['params']);
      $parts    = explode('/', $urlParts[0]);

      // if params starts with '/'
      if($parts[0] == '') {
        $parts = array_slice($parts,1);
      }

      foreach ($parts as $part) {
        $orders[] = $part;
      }

      // addin the get params
      if(isset($urlParts[1])) {
        $pairs  = explode('&',$urlParts[1]);
        $keyVal = array();

        foreach($pairs as $pair) {
          if(preg_match('/=/', $pair)) {
            $keyVal                               = explode('=',$pair);
            $this->scope->params->get[$keyVal[0]] = $keyVal[1];
          }
        }
      }

      $this->scope->orders = $orders;
    }
  }
}