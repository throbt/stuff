<?php

class getSession {
  public function &get($scope = '') {
    static $obj;
    if (!is_object($obj)){
      $obj = new Session($scope);
    }
    return $obj;
  }
}

class Session {
  function __construct($scope = '') {
    $this->scope = $scope;
  }
  
  public function checkProfile() {
    if (!isset($_SESSION['sessionUser'])) {
      return false;
    } else {
    
      /*
        set up for ten minutes
      */
      if(time() - $_SESSION['sessionUser']->lastCheck > 600) {
        session_destroy();
        session_unset();
        return false;
      } else {
        $_SESSION['sessionUser']->lastCheck = time();
        return true;
      }
    }
  }
  
  public function setToken() {
    $_SESSION['token'] = md5(time());
  }
  public function checkToken($token) {
    if(isset($_SESSION['token'])) {
      if($_SESSION['token'] == $token) {
        unset($_SESSION['token']);
        return true;
      }
    }
    return false;
  }
}
