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
  
  public function getGalleriesByGallery() {
    $images = $this->router->loader->get('Images','model');
    echo json_encode($images->get(
      '',
      array(
        "
          select
            m.*,
            g.title as thisGallery
              from
                images m
            left join
                galleries g
            on
              m.gallery = g.id
            where
              g.title != 'index_action'
            and
              m.gallery = ?
          ",
        array($this->get['gallery'])
      )
    ));
    die();
  }

  public function delImage() {
    $images = $this->router->loader->get('Images','model');
    $images->delete($this->get['id']);
    echo 1;
    die();
  }

  public function saveImage() {
    $images = $this->router->loader->get('Images','model');
    $images->update(
      $this->get['id'],
      array(
      'lead'    => $this->get['lead'],
      'title'   => $this->get['title']
    ));
    echo 1;
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
  
  public function getGalleries() {
    $galleryModel = $this->router->loader->get('Galleries','model');
    echo json_encode(array_slice($galleryModel->get(),1));
    die();
  }

  public function saveSEO() {
    $linx_model = $this->router->loader->get('Linx','model');
    //print_r($this->get);

    $linx_model->update(
      $this->get['id'],
      array(
      'thisorder'   => $this->get['order'],
      'params'      => $this->get['params']
    ));
    echo 1;
    die();
  }

  public function saveNewSEO() {
    $linx_model = $this->router->loader->get('Linx','model');
    $linx_model->create(array(
      'thisorder'         => $this->get['order'],
      'params'            => $this->get['params']
    ));

    echo 1;
    die();
  }

  public function delSEO() {
    $linx_model = $this->router->loader->get('Linx','model');
    $linx_model->delete($this->get['id']);
  }
}
