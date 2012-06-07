<?php

class Front_controller extends Controller {
	
  public function init() {
    $this->model = $this->router->loader->get('Article','model');
  }
  
  public function index() {
	
    $this->title = 'Evoline - home';

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->model->codeIt($this->model->get())
      ),
      $this->view->getTemplatePath('front','index')
    );

		echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );

  }
  
  public function show() {
		//echo "show:  id={$this->router->params->index}";  
  }
  

  public function create() {
    print_r($this->router->params);
		echo 'create';
  }

	public function update() {
    echo 'update';
  }
	
	public function delete() {
    echo 'delete';
  }

  public function thisTest() {
    /*
      lefut a controller/thisTest uri-ra

      a template alapvetoen  a view/controller/thisTest.tpl,

      de persze bmit valaszthatsz

      $this->content  = $this->view->renderTemplate($variable,$template);


      $template       = $this->view->getTemplatePath('home','index');  <= view/controller | view/controller/action.tpl
      $this->content  = $this->view->renderTemplate(array(
        'scope' => $this,
        'data'  => $data
      ),$template);
    */
  }
}
