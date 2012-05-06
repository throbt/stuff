<?php

class getView {
  public function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new View();
    }
    return $obj;
  }
}

class View {

  function __construct() {
    $this->init();
	}

  public function init() {

  }
	
  public function getTemplatePath($class,$method) {
    return VIEWS . DIRECTORY_SEPARATOR . $class . DIRECTORY_SEPARATOR . $method . DIRECTORY_SEPARATOR . $method . '.tpl';
  }

  public function renderTemplate($var, $template) {
   $this->var	 = $var;
   $content		 = '';
   
   ob_start();
   $this->loadTemplate($template);
   $content = ob_get_contents();
   ob_end_clean();
   return $content;
  }

  public function loadTemplate($template) {
    if(!include_once($template)) {
      throw new Exception("the template file is missisng: {$template}");
    }
  }

  // public function render() {
  //  $this->menu		 = $this->urlParts[0] == 'login' ? '' : $this->renderTemplate($this->menu, 'menu');
  //  $this->content	 = !isset($this->content)	 ? $this->renderTemplate($this->session->setToken(), $this->tpl) : $this->content;
  //  $this->header	 = !isset($this->header)	 ? $this->renderTemplate('', 'header') : $this->header;
  //  $this->footer	 = !isset($this->footer)	 ? $this->renderTemplate('', 'footer') : $this->footer;
  //  $this->frame		 = $this->renderTemplate(array(
  // 	 'content' => $this->content,
  // 	 'header'	 => $this->header,
  // 	 'footer'	 => $this->footer,
  // 	 'menu'		 => $this->menu
  //  ), 'frame');
   
  //  echo $this->frame;
  // }
}