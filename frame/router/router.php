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
	@class Router
*/
class Router {

	function __construct() {
		global $loader;
		$this->loader 	= $loader;
		global $session;
		$this->session 	= $session;
		$this->loader->load('Controller');
		$this->loader->load('Model');
		$this->loader->load('Module');
		$this->loader->load('Node');
		$this->loader->load('Taxonomy');
		$this->params = new stdClass();
		$this->setParams();
		$this->route();
	}

	/*
    @method route

    @return no return
  */
	private function route() {

		//$this->log($_SERVER['REQUEST_URI']);

		$this->setOrder();

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
			routing
		*/
		if(isset($this->orders[1])) {
			if((int)$this->orders[1] > 0) {
				$this->params->index = (int)$this->orders[1];
			}
		}

		if($this->orders[0] == '') {
			$this->scope 	= 'Home';
			$home 				= $this->link(strtolower($this->scope));
			header("location: /{$home}");
		} else {
			$this->scope = $this->orders[0];
		}
		
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
					if(isset($this->params->post['_method'])) {
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
					} else {
						$action = $this->orders[1];
					}
				} else {
					$action = $this->orders[1];
				}
			break;
		}

		/* iForm exception */
		if($this->scope == 'iform') {
			$action = 'router';
		}

		//$this->log($action);

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
			404
		*/
		if($this->scope == 'page404') {
			$page404 = $this->loader->get('page404','controller',$this);
			$page404->index();
		}

		/*
			loading action
		*/
		if(isset($controller)) {

			/*try {
				$controller->$action();
			} catch (Exception $e) {
				throw new Exception("invalid action: {$this->action}");
			}*/

			if(method_exists($controller, $action)) {
				$controller->$action();
			} else {
				$page404 = $this->loader->get('page404','controller',$this);
				$page404->index();
			}

		} else {
			/*
				404
			*/
			$controller = $this->loader->get($this->scope,'controller');
		}
	}

	/*
    @method link

    @param $link string
    @return string
  */
	public function link($link) {
		if(!isset($this->linkModel)) {
			$this->linkModel = $this->loader->get('linx','model');
		}

		if(!isset($this->linx)) {
			$linx = $this->linkModel->get();
			if($linx) {
				foreach($linx as $l) {
					$this->linx[$l['params']] = $l['thisorder'];
				}
			}
		}

		if(isset($this->linx[$link])) {
			return $this->linx[$link];
		} else {
			return $link;
		}
	}

	/*
    @method setOrder
    @return no return
  */
	public function setOrder() {
		$parts				= explode('?',$_SERVER['REQUEST_URI']);
		$this->orders = array_slice(explode('/',$parts[0]),1);
	}

	/*
    @method getOrder
    @return array
  */
	public function getOrder() {
		return $this->orders;
	}

	/*
    @method setParams
    @return no return
  */
	private function setParams() {
		$this->params->post = $_POST;
		$this->params->get	= $_GET;
		unset($_POST);
		unset($_GET);
	}

	/*
    @method getParams
    @return array
  */
	public function getParams() {
		return $this->params;
	}

	/*
    @method log
    @return no return
  */
	public function log($str,$file='') {
		$file 		= ($file=='' ? WWW.'/log.txt' : $file);
		$current 	= file_get_contents($file);
		$current .= "{$str}\n";
		file_put_contents($file, $current);
	}

}
