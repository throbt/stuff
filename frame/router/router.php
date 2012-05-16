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
	Create	 {post}		(controller) 					- http post method with variable _method=create
	Read		 {get}		(controller/[:index]) - simple get
	Update	 {put}		(controller/[:index]) - http post method with variable _method=put
	Delete	 {delete} (controller/[:index]) - http post method with variable _method=delete
	
	crud instead of rest
*/
class Router {
	function __construct() {
		global $loader;
		$this->loader 	= $loader;
		global $session;
		$this->session 	= $session;
		$this->loader->load('Controller');
		$this->loader->load('Model');
		$this->loader->load('Node');
		$this->params = new stdClass();
		$this->setParams();
		$this->route();
	}
	
	private function route() {

		$this->setOrder();
		
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
			doing the necessary preinit stuff

			for example:
				- overwrite the orders - {SEO - speaking urls}
				- set up the language env var
				- manage the access rules, etc
		*/
		try {
			$preinit = $this->loader->get('Preinit_hook','controller',$this);
		} catch (Exception $e) {}

		if($preinit != null) {
			// preinit hook is finished
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
							if(isset($this->orders[1])) {
								$action = $this->orders[1];
							} else {
								$this->scope = 'page404';
							}
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
	}
	
	public function setOrder() {
		$parts				= explode('?',$_SERVER['REQUEST_URI']);
		$this->orders = array_slice(explode('/',$parts[0]),1);
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

