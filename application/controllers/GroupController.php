<?php

class GroupController extends MaximaBaseController {

    public function init() {
      $params = $this->getRequest()->getParams();
      if(isset($params['token'])) {
        if(!$this->isValidRequest($params['token']))
          die('false');
      } else {
        die('false');
      }
    }

    public function indexAction() {
      $sessionUser  = new Zend_Session_Namespace('sessionUser');
      $groups       = new Application_Model_Groups();
      echo Zend_Json::encode($groups->getAll($sessionUser));
      $this->_helper->viewRenderer->setNoRender(true);
      die();
    }

    public function showAction() {
      $params = $this->getRequest()->getParams();
      $id     = $params["stub"];
      $groups = new Application_Model_Groups();
      echo  Zend_Json::encode($groups->getGroup($id));
      $this->_helper->viewRenderer->setNoRender(true);
    }

    public function addAction() {
        
    }

    public function editAction() {
        
    }

    public function deleteAction() {
        
    }
}









