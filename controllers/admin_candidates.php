<?php

class Admin_candidates_controller extends Controller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Candidates','model');
    $this->itemPerPage  = 15;
  }

  public function index() {

    $res = $this->model->getAll(

      "select
          c.*,
          p.title as title
          from
            candidates c
        left join
           positions p
        on c.position = p.id

        order by
          c.id",

      "select
        count(*) as counter
          from
            candidates",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $this->title   = 'Jelentkezők';

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
      $this->view->getTemplatePath('admin_candidates','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function dload() {
    if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
      $res = $this->model->select("
        select file from candidates where id = ?
      ",array($this->router->orders[2]));

      if(isset($res[0]['file'])) {
        $this->redirect("upload/cv/{$res[0]['file']}");
        die();
      }
    }
  }

}
