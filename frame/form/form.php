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
			'checkbox',
			'select',
			'file',
      'password'
		);
  }

  /*
    @method getTemplatePath

    @param $type string
    @return string
  */
  public function getTemplatePath($type) {
    return 'form' . DIRECTORY_SEPARATOR . 'tpl' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $type . '.tpl';
  }
  
  /*
    @method getTemplatePath

    @param $cfg array
    @return string
  */
  public function render($cfg) {
  	$this->content = '';
  	foreach($cfg['elements'] as $arr) {
  	
  	  if($arr['type'] == 'special') {
        if(isset($arr['src'])) {
          $this->content .= file_get_contents(ini_get('include_path')."/form/tpl/special/{$arr['src']}.tpl");
        } else if(isset($arr['html'])) {
          $this->content .= $arr['html'];
        }
  	  }
  	
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
  	return $this->view->renderTemplate($cfg['form'],$thisForm);
  }
}
