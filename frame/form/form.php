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

  public function render($cfg) {
  	$this->content = '';
  	foreach($cfg['elements'] as $el => $arr) {
  		if(/*method_exists($this,$el)*/ in_array($el,$this->inputs)) {
  			$this->content .= $this->view->renderTemplate($arr,$this->view->getTemplatePath('form',$el)); 
  		}
  	}
  	return $this->content;
  }

  /*public function text($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','text')); 
  }
  public function hidden($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','hidden')); 
  }
  public function textarea($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','textarea')); 
  }
  public function radio($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','radio')); 
  }
  public function checkbox($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','checkbox')); 
  }
  public function button($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','button')); 
  }
	public function submit($arr) {
  	return $this->view->renderTemplate($arr,$this->view->getTemplatePath('form','submit')); 
  }*/
}