<?php

class ExtTemplateController extends MaximaBaseController
{

    public function init() {
        /* Initialize action controller here */
    }
    
    public function testAction() { 
        // action body
        
    }

    public function indexAction() {
      
      $params = $this->getRequest()->getParams();
      
      $language_elements = array();  
      $lang_cats = array(8,17);
      $lang   = new Application_Model_Lang();
      
      $res = array(); 
      for($i = $lang_cats[0]; $i <= $lang_cats[1]; $i++) {
        $res = $lang->getLanguageItems($i,$params['lang']);
        $language_elements = array_merge_recursive($language_elements,$res);
      }
      
      $this->view->lang_items         = $language_elements; //die(print_r( $this->view->lang_items ));
      $this->view->lang_items['json'] = Zend_Json::encode($language_elements); //die(print_r($this->view->lang_items));
    }
    
    public function translateAction() {
    }


}

