<?php

class getPDO{
  static function &get(){
    static $obj;
    
    $conf   = getConfig::get();
    $config = $conf->get('db');  //print_r($config); die();
    
    if (!is_object($obj)){
      $obj = new PDO("pgsql:host={$config["host"]};dbname={$config["db"]}", $config["user"], $config["psw"]);
    }
    return $obj;
  }
}
