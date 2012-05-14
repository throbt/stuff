<?php

class getSession {
  static function &get($scope = '') {
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
        ten minutes
      */
      if(time() - $_SESSION['sessionUser']->lastCheck > 600) {
        session_destroy();
        session_unset();
        unset($_SESSION['sessionUser']);
        return false;
      } else {
        $_SESSION['sessionUser']->lastCheck = time();
        return true;
      }
    } /*else {
      return true;
    }*/
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

  public function setLanguage($get) {
    if(isset($_SESSION['language'])) { //echo "_SESSION:   " . $_SESSION['language'];
      if(isset($get['lang']) && $get['lang'] != $_SESSION['language']) {
        $_SESSION['language'] = $get['lang'];
      } else {

      }
    } else {
      if(isset($get['lang'])) {
        $_SESSION['language'] = $get['lang'];
      } else {
        $_SESSION['language'] = 'hu';
      }
    }
  }
}
