<?php

class Admin_ajax_controller extends Controller {

  public function init() {
    global $session;
    if($session->checkProfile('ajax')) {
      $this->model = $this->router->loader->get('Langelements','model');
    } else {
      echo 'false';
      die();
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
    die();
  }
  
  public function saveLangElements() {
    $this->model->update(
      $this->get['id'],
      array(
      'hu'  => $this->get['hu'],
      'en'  => $this->get['en'],
      'de'  => $this->get['de']
    ));
    echo 1;
    die();
  }
  
  public function setActive() {
    $model = $this->router->loader->get($this->get['model'],'model');
    $model->update(
      $this->get['id'],
      array(
      'active'  => $this->get['active']
    ));
  }
}
