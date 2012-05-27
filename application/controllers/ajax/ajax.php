<?php

class Ajax_controller extends Controller {

  public function init() {
  }
  
  public function getDrinksByCat() {

    $this->model = $this->router->loader->get('Drinks','model');

    $result = array();
    $res    = $this->model->get(
      '',
      array(
        "
        select
          *
            from
              drinks
              
        where
          categories = ?
        and
            title != 'index_action'
        ",
        array($this->get['cat'])
      )
    );

    foreach ($res as $r) {
      $result[$r['type']][] = $r;
    }

    echo json_encode($result);

    die();
  }

  public function getImagesByGallery() {
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
  
  
}
