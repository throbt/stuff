<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
  
	protected function _initRoutes() {  
    
    $ctrl = Zend_Controller_Front::getInstance();
    $router = $ctrl->getRouter();
    
    /*$router->addRoute(
        'extTemplate', new Zend_Controller_Router_Route(
          'extTemplate/:stub',
          array(
            'controller'  => 'extTemplate',
            'action'      => 'index'
          )
        )
    );
    
    /*$router->addRoute(
        'group', new Zend_Controller_Router_Route(
          'group/:stub',
          array(
            'controller'  => 'group',
            'action'      => 'show'
          )
        )
    );*/
    
    /*$router->addRoute(
        'login', new Zend_Controller_Router_Route(
          'logout/:stub',
          array(
            'controller'  => 'login',
            'action'      => 'logoutAction'
          )
        )
    );*/
  }
  
  protected function _initSession() {
    Zend_Session::start();
    $sessionUser = new Zend_Session_Namespace('sessionUser');
  }
  
  
  protected function _initPaths() { 
    preg_match("/(.*)(\/index\.php)/", $_SERVER["SCRIPT_NAME"], $matches);
    
    define('WEB_ROOT',  "http://{$_SERVER['HTTP_HOST']}{$matches[1]}");
    
    $rootDir = dirname(dirname(__FILE__));
    define('ROOT_DIR',  $rootDir);
    define('EXTRA_DIR', "{$rootDir}/application/library/extra/");
    
    set_include_path(get_include_path()
      . PATH_SEPARATOR . ROOT_DIR . '/application/library/forms/'
      . PATH_SEPARATOR . ROOT_DIR . '/library/'
      . PATH_SEPARATOR . ROOT_DIR . '/application/library/auth/'
    );
    
    Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
  }
}

