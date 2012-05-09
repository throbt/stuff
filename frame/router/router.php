<?php

class getRouter {
	static function &get($scope = '') {
		static $obj;
		if (!is_object($obj)){
			$obj = new Router($scope);
		}
		return $obj;
	}
}

/*
	Create	 {post}		(controller) 					- http post method with a _method=create variable
	Read		 {get}		(controller/[:index]) - simple get
	Update	 {put}		(controller/[:index]) - http post method with a _method=put variable
	Delete	 {delete} (controller/[:index]) - http post method with a _method=delete variable
	
	crud instead of rest
*/
class Router {
	function __construct() {
		global $loader;
		$this->loader = $loader;
		$this->loader->load('Controller');
		$this->loader->load('Model');
		$this->params = new stdClass();
		$this->setParams();
		$this->setOrder();
	}
	
	private function setOrder() {
		$parts				= explode('?',$_SERVER['REQUEST_URI']);
		$this->orders = array_slice(explode('/',$parts[0]),1);
		
		if(isset($this->orders[1])) {
			if((int)$this->orders[1] > 0) {
				$this->params->index = (int)$this->orders[1];
			}
		}
		
		if($this->orders[0] == '') {
			$this->scope = 'home';
		} else {
			$this->scope = $this->orders[0];
		}
		
		/*
			C R U D
		*/
		switch($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				if(!isset($this->orders[1]) || $this->orders[1] == '') {
					$action = 'index';
				} else if(isset($this->params->index)) {
					$action = 'show';
				} else {
					$action = $this->orders[1];
				}
			break;
			case 'POST':
				if($this->params->post) {
					switch($this->params->post['_method']) {
						case 'create':
							$action = 'create';
						break;
						case 'update':
							if(isset($this->params->index)) {
								$action = 'update';
							} else {
								$this->scope = 'page404';
							}
						break;
						case 'delete':
							if(isset($this->params->index)) {
								$action = 'delete';
							} else {
								$this->scope = 'page404';
							}
						break;
						default:
							$this->scope = 'page404';
						break;
					}
				} 
			break;
		}
		
		/*
			loading controller
		*/
		if($this->scope != 'page404') {
			try {
				$this->action = $action;
				$controller 	= $this->loader->get($this->scope,'controller',$this);
			} catch (Exception $e) {
				$this->scope 	= 'page404';
			}
		}
		/*
			loading action
		*/
		if(isset($controller)) {
			try {
				$controller->$action();
			} catch (Exception $e) {
				throw new Exception("invalid action: {$this->action}");
			}
		} else {
			/*
				404
			*/
			$controller = $this->loader->get($this->scope,'controller');
		}

		//echo $this->controller->render();
	}
	
	public function getOrder() {
		return $this->orders;
	}
	
	private function setParams() {
		$this->params->post = $_POST;
		$this->params->get	= $_GET;
		unset($_POST);
		unset($_GET);
	}
	
	public function getParams() {
		return $this->params;
	}
	
}

