<?php

class Controller {
  function __construct($scope) {
    global $loader;
    $this->router     = $scope;
		$this->loader     = $loader;
		$this->post       = isset($this->router->params->post)  ? $this->router->params->post   : null;
		$this->get        = isset($this->router->params->get)   ? $this->router->params->get    : null;
		$this->index 	    = isset($this->router->params->index) ? $this->router->params->index  : null;
    $this->view       = $this->loader->get('View');
    $this->htmlRender = true;
    $this->tpl        = '';
    $this->variable   = '';
    $this->init();
  }
  
  public function init() {
  }

  /*
    @method getajaxHeader
    @return no return
  */
  public function getajaxHeader() {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
  }

  /*
    @method render
    @return string
  */
  public function render() {
    if($this->htmlRender) {
      if($this->tpl == '') {
        $this->tpl = $this->view->getTemplatePath($this->router->scope,$this->router->method);
        return $this->view->renderTemplate(($this->variable != '' ? $this->variable : ''),$this->tpl);
      }
    }
  }

  /*
    @method render
    $param $nextRoute string - optional
    @return string
  */
	public function redirect($nextRoute = '') {
		$route = ($nextRoute != '' ? $nextRoute : 'home');
		header("location: /{$route}");
	}
}
