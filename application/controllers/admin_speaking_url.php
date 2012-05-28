<?php

class Admin_speaking_url_controller extends Controller {
  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Linx','model');
    $this->itemPerPage  = 10;
  }

  public function index() {
    $this->title = 'SEO';

    $res = $this->model->getAll(

      "select
          *
          from
            linx",

      "select
        count(*) as counter
          from
            linx",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $paginator = $this->view->renderTemplate(
      array(
        'all'     => $res['all'],
        'current' => $res['current'],
        'url'     => implode('/',$this->router->orders)
      ),
      $this->view->getTemplatePath('paginator','paginator')
    );

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $res['result'],
        'paginator' => $paginator
      ),
      $this->view->getTemplatePath('admin_speaking_url','index')
    );

    // $this->content = $this->view->renderTemplate(
    //   array(
    //     'scope'     => $this,
    //     'data'      => $res
    //   ),
    //   $this->view->getTemplatePath('admin_speaking_url','index')
    // );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
}