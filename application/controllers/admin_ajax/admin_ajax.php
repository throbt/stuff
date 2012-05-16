<?php

class Admin_ajax_controller extends Controller {

  public function init() {
    global $session;
    if($session->checkProfile()) {
      $this->model = $this->router->loader->get('Langelements','model');
    } else {
      $this->redirect('page404');
    }
    
  }
  
  public function getLangElementsByType() {
    echo json_encode($this->model->get(
      '',
      array(
        "
        select
          *
            from
              langelements
        where
          type = ?
        ",
        array($this->get['type'])
      )
    ));
  }
}
