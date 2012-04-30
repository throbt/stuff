<?php

class getPDO{
  public function &get(){
    static $obj;
    
    $conf   = getConfig::get();
    $config = $conf->get('db');
    
    if (!is_object($obj)){
      //mysql_connect("{$config["host"]}","{$config["user"]}","{$config["psw"]}");
      $obj = new PDO("mysql:host={$config["host"]};dbname={$config["db"]}", $config["user"], $config["psw"]);
    }
    return $obj;
  }
}
