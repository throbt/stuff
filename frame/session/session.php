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

  function __construct($scope=null) {
    $this->scope = $scope;

    global $loader;
    $this->loader   = $loader;
  }

  /*
    @method addObject

    @param $nameSpace string
    @param $params array|object
    @return no return
  */
  public function addObject($nameSpace,$params = '') {
    if(isset($params) && $params != '') {
      $_SESSION[$nameSpace] = new stdClass();
      if(gettype($params) == 'array') {
        foreach($params as $k => $v) {
          $_SESSION[$nameSpace]->$k = $v;
        }
      } else {
        $_SESSION[$nameSpace] = $params;
      }
    }
  }

  /*
    @method readObject

    @param $nameSpace string
    @return object
  */
  public function readObject($nameSpace) {
    if($this->isObject($nameSpace))
      return $_SESSION[$nameSpace];
    else
      return false;
  }

  /*
    @method isObject

    @param $nameSpace string
    @return boolean
  */
  public function isObject($nameSpace) {
    if(isset($_SESSION[$nameSpace]))
      return true;
    else
      return false;
  }

  /*
    @method checkProfile

    @param $job string
    @return boolean
  */
  public function checkProfile($job='') {
    if (!isset($_SESSION['profile'])) {
      return false;
    } else {

      /*
        an hour
      */
      if(time() - $_SESSION['profile']->lastCheck > 3600) {
        if($job != 'ajax') {
          //session_destroy();
          //session_unset();
        }
        unset($_SESSION['profile']);
        return false;
      } else {
        if(!isset($this->profile))
          $this->profile = $this->loader->get('Profile');

        /* validate the profile of the session */
        $thisProfile = $this->profile->getProfile($_SESSION['profile']->email,$_SESSION['profile']->password);
        if($thisProfile) {
          if($thisProfile['email'] == $_SESSION['profile']->email && $thisProfile['password'] == $_SESSION['profile']->password) {
            $_SESSION['profile']->lastCheck = time();
            return true;
          }
        }
      }
    }
    return false;
  }

  /*
    @method setProfile

    @param $profile array
    @return no return
  */
  public function setProfile($profile) {
    $_SESSION['profile'] = new stdClass();
    foreach($profile as $k => $v) {
      $_SESSION['profile']->$k = $v;
    }
    $_SESSION['profile']->lastCheck = time();
  }

  /*
    @method setToken

    @return no return
  */
  public function setToken() {
    $_SESSION['token'] = md5(time());
  }

  /*
    @method setProfile

    @param $token string
    @param $ajax  string
    @return boolean
  */
  public function checkToken($token,$ajax = 'ajax') {
    if(isset($_SESSION['token'])) {
      if($_SESSION['token'] == $token) {
        if($ajax != 'ajax')
          unset($_SESSION['token']);
        return true;
      }
    }
    return false;
  }

  /*
    @method setLanguage

    @param $get array
    @return no return
  */
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

  /*
    @method setSysMessages

    @param $key     string
    @param $message string
    @return no return
  */
  public function setSysMessages($key,$message) {
    $_SESSION['messages'][$key]             = new stdClass();
    $_SESSION['messages'][$key]->message    = $message;
    $_SESSION['messages'][$key]->displayed  = 0;
  }

  /*
    @method getSysMessages

    @param $key     string
    @return string
  */
  public function getSysMessages($key) {
    if(isset($_SESSION['messages'][$key]))
      return $_SESSION['messages'][$key]->message;
    return null;
  }

  /*
    @method delNameSpace

    @return no return
  */
  public function delNameSpace($namespace) {
    if(isset($_SESSION[$namespace])) {
      unset($_SESSION[$namespace]);
    }
  }

  /*
    @method destroy

    @return no return
  */
  public function destroy() {
    foreach ($_SESSION as $k => $v) {
      unset($_SESSION[$k]);
    }
    session_destroy();
    session_unset();
  }
}
