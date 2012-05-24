<?php

class Foods_controller extends Controller {

  public function init() {
    $this->model        = $this->router->loader->get('Foods','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $result = array();
    $res    = $this->model->get(
      '',
      array(
        "
          select
            *
              from
                foods
          where
            title != 'index_action'
          and
            lang = ?
        ",
        array($_SESSION['language'])
      )
    );

    foreach ($res as $r) {
      $result[$r['type']][] = $r;
    }

    $this->title   = 'Étlap';

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $result
      ),
      $this->view->getTemplatePath('foods','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }

  

  public function show() {
    $drink        = $this->model->get($this->index); print_r($drink);
    $this->title    = $drink[0]['title'];

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => 'bla'
      ),
      $this->view->getTemplatePath('page','page')
    );

  }

  
}
