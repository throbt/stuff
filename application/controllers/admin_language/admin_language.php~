<?php

class Admin_language_controller extends Controller {

  public function init() {
    $this->model = $this->router->loader->get('Langelements','model');
  }

  public function index() {
    $this->content  = array();
    $this->title    = 'Kifejezések';
    
    $types          = $this->model->get(
      '',
      array(
        "
        select
          type
            from
              langelements
        group by
          type
        ",
        array()
      )
    );
    
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => array(
          'types' => $types
        )
      ),
      $this->view->getTemplatePath('admin_language','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
}
