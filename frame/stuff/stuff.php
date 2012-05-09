<?php

class getStuff {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Stuff();
    }
    return $obj;
  }
}

class Stuff {

  function __construct() {
  }
  
  public function debug($stuff) {
		echo "<pre>";
			print_r($stuff);
		echo "</pre>";
	}
	
	public function getBaseUriForPaginator() {
    $url = $_SERVER['REQUEST_URI'];
    if(preg_match('/(.*)(page)/',$url,$matches)) {
      $url = $matches[1];
      if(preg_match("/(.*)(\&)/",$url,$matches)) {
        $url = $matches[0];
      } else if(preg_match("/(.*)(\?)/",$url,$matches)) {
        $url = $matches[0];
      } 
    } else if(preg_match("/(.*)(\?)/",$url,$matches)) {
      $url .= '&';
    } else {
      $url .= '?'; 
    }
    return $url;
  }
}
