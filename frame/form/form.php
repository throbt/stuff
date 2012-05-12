<?php

class getForm {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Form();
    }
    return $obj;
  }
}

class Form {

	function __construct() {
		global $loader;
		$this->view 	= $loader->get('View');
		$this->inputs = array(
			'button',
			'text',
			'hidden',
			'textarea',
			'radio',
			'submit',
			'checkbox'
		);
  }

  public function getTemplatePath($type) {
    return 'form' . DIRECTORY_SEPARATOR . 'tpl' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $type . '.tpl';
  }

  public function render($cfg) {
  	$this->content = '';
  	foreach($cfg['elements'] as $arr) {
  		if(/*method_exists($this,$el)*/ in_array($arr['type'],$this->inputs)) {

        if(isset($cfg['form']['template']) && $cfg['form']['template'] == 'view') {
          $thisPath = $this->view->getTemplatePath('form',$arr['type']);
          $thisForm = $this->view->getTemplatePath('form',$arr['type']);
        } else if(!isset($cfg['form']['template']) || $cfg['form']['template'] == 'default') {
          $thisPath = $this->getTemplatePath($arr['type']);
          $thisForm = $this->getTemplatePath('form');
        }
  		  
        $this->content .= $this->view->renderTemplate($arr,$thisPath);
  		}
  	}
    $cfg['form']['content'] = $this->content;
  	return $this->view->renderTemplate($cfg['form'],$this->view->getTemplatePath('form','form'));
  }
}