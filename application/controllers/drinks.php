<?php

class Drinks_controller extends Controller {

  public function init() {
    $this->model        = $this->router->loader->get('Drinks','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res = $this->model->get(
      '',
      array(
        "
          select
            categories
              from
                drinks
          
          where
            title != 'index_action'

          group by
            categories
        ",
        array()
      )
    );

    $this->title   = 'Itallap';

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $res
      ),
      $this->view->getTemplatePath('drinks','index')
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
