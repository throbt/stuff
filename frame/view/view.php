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
    $this->scope = $scope;
    $this->init();
	}

  public function init() {
  }
	
  /*
    @method getTemplatePath

    @param $class   string
    @param $method  string
    @return string
  */
  public function getTemplatePath($class,$method) {
    if($class == 'admin') {
      return REPO . $class . DIRECTORY_SEPARATOR . 'tpl' . DIRECTORY_SEPARATOR . $method . '.tpl';
    } else {
      return VIEWS . DIRECTORY_SEPARATOR . $class . DIRECTORY_SEPARATOR . $method . '.tpl';
    }'.tpl';
  }

  /*
    @method renderTemplate

    @param $var       array
    @param $template  string
    @return string
  */
  public function renderTemplate($var, $template) {
   $this->var	 = $var;
   $content		 = '';
   
   ob_start();
    $this->loadTemplate($template);
    $content = ob_get_contents();
   ob_end_clean();

   return $content;
  }

  /*
    @method getFileContent

    @param $class   string
    @param $method  string
    @return string
  */
  public function getFileContent($class,$method) {
    return file_get_contents(VIEWS . DIRECTORY_SEPARATOR . $class . DIRECTORY_SEPARATOR . $method . '.tpl');
  }

  /*
    @method loadTemplate

    @param $template   string
    @return no return
  */
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
    @method link - wrapper for router::link

    @param $original_link   string
    @return string
  */
  public function link($original_link) {
    return $this->var['scope']->router->link($original_link);
  }

}