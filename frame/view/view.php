<?php

class getView {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new View();
    }
    return $obj;
  }
}

class View {

  function __construct($scope='') {
    $this->scope = $scope; //print_r($this->scope->router);
    $this->init();
	}

  public function init() {
  }
	
  public function getTemplatePath($class,$method) {
    return VIEWS . DIRECTORY_SEPARATOR . $class . DIRECTORY_SEPARATOR . $method . '.tpl'; //$method . DIRECTORY_SEPARATOR . $method . '.tpl';
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

  public function getFileContent($class,$method) {
    return file_get_contents(VIEWS . DIRECTORY_SEPARATOR . $class . DIRECTORY_SEPARATOR . $method . '.tpl');
  }

  public function loadTemplate($template) {
    if(!include($template)) {
      throw new Exception("the template file is missisng: {$template}");
    }

    /*try {
      $content = file_get_contents($template);
      return $content;
    } catch (Exception $e) {
      throw new Exception("the template file is missisng: {$template}");
    }*/
  }

  /*
    @link method - wrapper for $router->link
  */
  public function link($original_link) {
    return $this->var['scope']->router->link($original_link);
  }

}