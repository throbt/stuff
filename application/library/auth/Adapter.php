<?php

class Adapter implements Zend_Auth_Adapter_Interface {
  
  protected $username;
  protected $password;
  
  public function __construct($arr) {
    $this->username = $arr["username"];
    $this->password = $arr["password"];
  }
  
  public function authenticate() {
    
    $users  = new Application_Model_User();
    $user   = $users->getUser($this->username);
    
    if(count($user) == 0) {
      return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,$this->username, array("nincs ilyen nevu felhasznalo"));
    }
    
    if($this->username == $user["username"] && $this->password != $user["password"]) {
      return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,$this->password);
    }
    
    if($this->username != $user["username"] && $this->password == $user["password"]) {
      return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,$this->username, array("nincs ilyen nevu felhasznalo"));
    }
    
    if($this->username != $user["username"] && $this->password != $user["password"]) {
      return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,"{$this->username},{$this->password}");
    }
    
    $sessionUser              = new Zend_Session_Namespace('sessionUser');
    $sessionUser->username    = $this->username;
    $sessionUser->profile     = $user;
    
    return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS,$this->username);
  }
}
