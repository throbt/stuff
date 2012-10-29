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
    @method get

    @param $className string
    @param $type      string
    @param $scope     string
    @return no return
  */
  public function load($className,$type='',$scope='') {
    $this->className = $className;
    switch($type) {
      case 'controller':
        switch($className) {
          case 'admin':
            $path             = REPO        . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
            $this->className .= '_controller';
          break;
          case 'iform':
            $path             = REPO        . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
            $this->className .= '_controller';
          break;
          default:
            $path             = CONTROLLERS . strtolower($className) . '.php';
            $this->className .= '_controller';
          break;
        }
      break;
      case 'model':
        $path             = MODELS      . strtolower($className) . '.php';
        $this->className .= '_model';
      break;
      case 'module':
        $path             = MODULES     . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
        $this->className .= '_module';
      break;
      case 'view':
        $path             = VIEWS       . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
        $this->className .= '_view';
      break;
      case 'helper':
        switch($className) {
          case 'Admin':
            $path             = REPO      . strtolower($className) . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
            $this->className .= '_helper';
          break;
          default:
            $path             = HELPERS   . strtolower($className) . DIRECTORY_SEPARATOR  . strtolower($className) . '.php';
            $this->className .= '_helper';
          break;
        }
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
    @method get

    @param $className string
    @param $type      string
    @param $scope     string
    @return object
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
