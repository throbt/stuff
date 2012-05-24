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
  
  
}
