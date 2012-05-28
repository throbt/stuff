<?php

class Gallery_controller extends Controller {

  public function init() {
    $this->model        = $this->router->loader->get('Galleries','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res = $this->model->get(
      '',
      array(
        "
          select

            g.*,
            i.name

          from
            galleries g

          left join
            images i
          on g.id = i.gallery

          where
            g.active = 'true'

          group by
            g.id
        ",
        array()
      )
    );

    $this->title   = 'Galériák';

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $res
      ),
      $this->view->getTemplatePath('gallery','index')
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
    // $drink        = $this->model->get($this->index); print_r($drink);
    // $this->title    = $drink[0]['title'];

    // echo $this->view->renderTemplate(
    //   array(
    //     'scope' => $this,
    //     'data'  => 'bla'
    //   ),
    //   $this->view->getTemplatePath('page','page')
    // );

  }

  
}
