<?php

class Cikkek_controller extends Controller {
  
  public function init() {
    $this->model = $this->router->loader->get('Article','model');
  }
  
  public function index() {

    $this->title    = 'Manna';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->model->get()
      ),
      $this->view->getTemplatePath('cikkek','index')
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

    $article        = $this->model->get($this->index);
    $this->title    = $article[0]['title'];
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $article
      ),
      $this->view->getTemplatePath('cikkek','show')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    ); 
  }
  
  public function thisTest() {
    echo 'thisTest';
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
}