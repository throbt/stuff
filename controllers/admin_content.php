<?php

class Admin_content_controller extends Controller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
  }

  public function index() {
    $this->title    = 'Tartalmak kezelése';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => ""
      ),
      $this->view->getTemplatePath('admin_content','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
}
?>
