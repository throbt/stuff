<?php

class Admin_programmes_controller extends Controller {

  public function init() {
    // $this->model = $this->router->loader->get('Home','model');
  }

  public function index() {

    $this->title    = 'Foglalások';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => 'admin_booking index'
      ),
      $this->view->getTemplatePath('admin_programmes','index')
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