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
    $thisClassName = $className;
		switch($type) {
      case 'controller':
        $path 					= CONTROLLERS . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
				$thisClassName .= '_controller';
      break;
      case 'model':
        $path 					= MODELS      . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
				$thisClassName .= '_model';
      break;
      case 'views':
        $path 					= VIEWS       . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
				$thisClassName .= '_view';
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
    $str        = "get{$className}";
    $thisClass  = false;
    if(class_exists($str)) {
      $class      = new $str();
      $thisClass  = $class->get($scope);
    } else if(class_exists($thisClassName)){
      $thisClass = new $thisClassName($scope);
    } else {
      throw new Exception("the class definition is missing: {$thisClass}");
    }
    
    return $thisClass;
  }
  
}
