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
  	$this->stuff = $this->scope->loader->get('Stuff');
  	$this->init();
  }

  public function init() {

    /*
      language
    */
  	//$this->scope->session->setLanguage($this->scope->params->get);

    
    //$this->mobileListener();

    /*
      seo urls
    */
    $this->setOrders();

    /*
      sys
    */
    $this->setSiteParams();

    /*
      messages
    */
    $this->setSysMessages();
  }

  public function setOrdersForQrCodes() {
    $qrLinx = array(
      'deg_mol'     => 'm/mol/59/landing',
      'deg_muemlek' => 'm/mol/59'
    );

    if (array_key_exists($this->scope->orders[0], $qrLinx)) {
      $key = $this->scope->orders[0];
      $routeParams = explode('/',$qrLinx[$key]);
      $this->scope->orders = $routeParams;
    }
  }

  public function setSysMessages() {
    if(isset($_SESSION['messages'])) {
      foreach($_SESSION['messages'] as $key => $message) {
        if($_SESSION['messages'][$key]->displayed > 0) {
          unset($_SESSION['messages'][$key]);
        } else {
          $_SESSION['messages'][$key]->displayed++;
        }
      }
      $this->scope->messages = $_SESSION['messages'];
    }
  }

  public function setSiteParams() {
    if(file_exists(CONFIG.'system.cfg')) {
      include CONFIG.'system.cfg';

      if(isset($sys)) {
        $res              = json_decode($this->stuff->sunesc($sys));
        $this->scope->sys = $res->system;
      } else {
        $this->scope->sys = array();
      }
    }
  }

  public function mobileListener() {
    /*$this->mobile = $this->scope->loader->get('Mobile');
    if(!$this->mobile->detect()) {
      if($this->scope->orders[0] != 'm') {
          $params = $this->scope->orders;
          array_unshift($params,'m');
          $new_link = implode('/',$params);
          header("location: /{$new_link}");
          die();
      } else {
        $this->setOrderForMobile();
      }
    } else {
      if($this->scope->orders[0] == 'm') {
        array_shift($params);
        $new_link = implode('/',$params);
        header("location: /{$new_link}");
        die();
      } else {
        $this->setOrderForMobile();
      }
    }*/

    $this->setOrderForMobile();
    
  }

  public function setOrderForMobile() {
    $orders = array();
    $params = $this->scope->orders;
    if($params[0] == 'm') {
      for($i = 1; $i < count($params); $i++) {
        $orders[] = $params[$i];
      }
      $this->scope->orders = $orders;
      $this->scope->mobile = true;
    } else {
      $this->scope->mobile = false;
    }
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
