<?php

class getConfig {
  public function &get($scope = '') {
    static $obj;
    if (!is_object($obj)){
      $obj = new Config($scope);
    }
    return $obj;
  }
}

class Config {

  public $vars = array();
  
  function __construct($scope = '') {
    $this->scope = $scope;
    $this->vars['db'] = array(
      "host"  => "localhost",
      "db"    => "f41_f45",
      "user"  => "f41_f45",
      "psw"   => "f41_f4523%"
    );
    
    define('CLASSES',       dirname(__FILE__) . '/');
    define('ROOT',          CLASSES . '/../');
    define('CONTROLLERS',   ROOT . '/controllers/');
    define('MODELS',        ROOT . '/models/');
    define('TPL',           ROOT . '/tpl/');
    define('WWW',           ROOT . '/www/');
    define('CSS',           WWW . '/css/');
    define('JS',            WWW . '/js/');
    define('IMG',           WWW . '/img/');
    
    define('HOST',          $_SERVER['HTTP_HOST']);
  }
  
  public function get($key) {
    return $this->vars[$key];
  }
}
