<?php

class LoginController extends Zend_Controller_Action {
  
  public function indexAction() {  
    $form = new LoginForm("login");
    echo  $form->getJSONCfg();
    $this->_helper->viewRenderer->setNoRender(true);
  }

  public function getAuthAdapter(array $params) {
    return new Adapter($params);
  }
  
  public function preDispatch() {
    $request  = $this->getRequest(); 
    
    if($request->getActionName() == "logout") {
      $this->logoutAction();
    }
    
    $auth = Zend_Auth::getInstance();
    if($auth->getIdentity() && $auth->getIdentity() != "") {
      $token                = new Zend_Session_Namespace('token');
      $sessionUser          = new Zend_Session_Namespace('sessionUser');
      $thisUser             = $sessionUser->profile;
      $thisUser['password'] = '';
      $thisUser['token']    = $token->logintoken;
      echo Zend_Json::encode(array("user" => $thisUser));
      die();
    }
  }
  
  public function processAction() {
    
    $request  = $this->getRequest();
    $form     = new LoginForm("login");
    
    if (!$request->isPost()) {
        return $this->_helper->redirector('index');
    }

    if (!$form->isValid($request->getPost())) {
        $this->view->form = $form;
        echo  $form->getJSONCfg();
        $this->_helper->viewRenderer->setNoRender(true);
        die();
    }

    $adapter = $this->getAuthAdapter($request->getPost());
    $auth    = Zend_Auth::getInstance();
    $result  = $auth->authenticate($adapter);
    
    //$user = new Application_Model_User();
    //echo Zend_Json::encode(array("user" => $user->getUser($auth->getIdentity())));
    
    $token                = new Zend_Session_Namespace('token');
    // generating a new token after the auth, it will be the session token to access the models
    $token->logintoken    = md5(rand(time(),true));
    $sessionUser          = new Zend_Session_Namespace('sessionUser'); //die( print_r( $sessionUser->profile ) );
    $thisUser             = $sessionUser->profile;
    $thisUser['password'] = '';
    $thisUser['token']    = $token->logintoken;
    echo Zend_Json::encode(array("user" => $thisUser));
  
    $this->_helper->viewRenderer->setNoRender(true);
    die();
  }
  
  public function logoutAction() {
    Zend_Session::namespaceUnset('sessionUser');
    Zend_Auth::getInstance()->clearIdentity();
    echo Zend_Json::encode(array("out" => 1));
    $this->_helper->viewRenderer->setNoRender(true);
    die();
  }
}
