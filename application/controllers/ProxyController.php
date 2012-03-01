<?php

class ProxyController extends Zend_Controller_Action {

    public function init() { 
        /* Initialize action controller here */
    }

    public function indexAction() {
    }

    public function dorequestAction() {
      require_once(EXTRA_DIR . "proxy/class_http.php");
      
      $proxy_url    = 'http://www.maxima.hu/extranet/proxy.php';
      $h            = new http();
      $h->url       = $proxy_url . '?' . $_SERVER['QUERY_STRING'];
      $h->postvars  = $_POST;
      /*$h->rawpost = HTTP_RAW_POST_DATA;*/
     
      $h->fetch($h->url);
      echo $h->body;
      
      /*if (!$h->fetch($h->url)) {
        header("HTTP/1.0 501 Script Error");
        echo "proxy.php had an error attempting to query the url";
        exit();
      }*/
      
      $this->_helper->viewRenderer->setNoRender(true);
      die();
    }

    public function showAction() {
    }

    public function addAction() {
        
    }

    public function editAction() {
        
    }

    public function deleteAction() {
        
    }
}









