<?php

class getLoader {
  public function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Loader();
    }
    return $obj;
  }
}

class Loader {

  function __construct() {
		global $config;
  }
  
  public function get($className,$type='',$scope='') {
    switch($type) {
      case 'controller':
        $path = CONTROLLERS . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
      break;
      case 'model':
        $path = MODELS      . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
      break;
      case 'views':
        $path = VIEWS     	. strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
      break;
			
			/*
				using the include_path directive, loading from mainframe
			*/
			default:
        $path = strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
      break;
    }

		/*
			fucking require_once doesnt throw exception
		*/
		if(!include_once($path)) {
			throw new Exception("the file is missisng: {$path}");
		}
		
		$str      	= "get{$className}";
    $thisClass  = false;
    if(class_exists($str)) {
      $class      = new $str();
      $thisClass  = $class->get($scope);
    } else if(class_exists($className)){
      $thisClass = new $className($scope);
    } else {
			throw new Exception("the class definition is missing: {$className}");
		}
		
		return $thisClass;
  }
  
}
