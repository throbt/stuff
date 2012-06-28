<?php

class getLoader {
  static function &get() {
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

  /*
    @load method loading the file

    @$className {string}
    @$type      {string}
    @$scope     {object}
  */
  public function load($className,$type='',$scope='') {
    $this->className = $className;
    switch($type) {
      case 'controller':
        $path             = CONTROLLERS . strtolower($className) . '.php';
        $this->className .= '_controller';
      break;
      case 'model':
        $path             = MODELS      . strtolower($className) . '.php';
        $this->className .= '_model';
      break;
      case 'view':
        $path             = VIEWS       . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
        $this->className .= '_view';
      break;
      case 'helper':
        $path             = HELPERS     . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
        $this->className .= '_helper';
      break;
      /*
        using the include_path directive, loading from mainframe
      */
      default:
        $path = strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
      break;
    }
    if(!include_once($path)) {
      throw new Exception("the file is missisng: {$path}");
    }
  }
  
  /*
    @get method loading the file and init the relevant class

    @$className {string}
    @$type      {string}
    @$scope     {object}
  */
  public function get($className,$type='',$scope='') {
    $this->load($className,$type,$scope);
    $str            = "get{$className}";
    $thisClass      = false;
    $thisClassName  = $this->className;
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
