<?php

class Controller {
  function __construct($scope = '') {
    if($scope != '')
      $this->router = $scope;
    $this->init();
  }
  
  public function init() {
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
