<?php

class MaximaBaseController extends Zend_Controller_Action {

  public function isValidRequest($_token) {
    $token = new Zend_Session_Namespace('token');
    if($_token == $token->logintoken)
      return true;
    else
      return false;
  }

}
