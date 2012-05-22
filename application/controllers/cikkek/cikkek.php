<?php

class Cikkek_controller extends Controller {
  public function init() {
    $this->model = $this->router->loader->get('Article','model');
  }

  public function index() {

  }

  public function show() {
    $res = $this->model->get($this->index);

    $this->title    = 'Manna';
    // $this->content  = $this->view->renderTemplate(
    //   array(
    //     'scope' => $this,
    //     'data'  => $this->model->get()
    //   ),
    //   $this->view->getTemplatePath('home','index')
    // );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $res[0]['title']
      ),
      $this->view->getTemplatePath('page','page')
    );
  }
}