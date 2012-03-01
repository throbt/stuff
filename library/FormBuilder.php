<?php

class FormBuilder {
 
 public $cfg = array();
 protected $form;
 
  public function __construct($form) {
    $this->form = $form;
    if(method_exists($this, $form)) {
      // bla $this->$form(); or sThing like this
    } else {
      //error
    }
  }  alert("ADASDASD");
  
  public function getCfg(){
    return $this->cfg;
  }
  
  public function getJSONCfg(){
    $this->cfg = $this->createForm();
    return Zend_Json::encode($this->cfg,false,array('enableJsonExprFinder' => true)); 
  }
  
  protected function setHash(){
    $thisStr          = "{$this->form}token";
    $token            = new Zend_Session_Namespace('token');
    $token->$thisStr  = md5($this->form.rand(time(),true));
    //$_SESSION["{$this->form}token"] = md5($this->form.rand(time(),true));
  }
  
  protected function getHash(){
    $token    = new Zend_Session_Namespace('token');
    $thisStr  = "{$this->form}token";
    if(!isset($token->$thisStr))
      $this->setHash();
    
    return $token->$thisStr;
  }
  
}
