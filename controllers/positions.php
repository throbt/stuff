<?php

class Positions_controller extends Controller {

  public function init() {
    $this->model            = $this->router->loader->get('Positions','model');
    $this->model->className = 'Positions';
    $this->stuff            = $this->router->loader->get('Stuff');
    $this->sys              = $this->router->sys;
  }

  public function show() {

    $this->node = $this->model->getPosition($this->router->params->index);

    if($this->node != null) {
      $this->menu           = array('url' => 'positions');
      $this->node[0]['nid'] = $this->node[0]['id'];
      $this->title          = $this->node[0]['title'];

      $this->content = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $this->codeItForContent($this->node)
        ),
        $this->view->getTemplatePath('content','show')
      );

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $this->content
        ),
        $this->view->getTemplatePath('page','page')
      );
    } else {
      $this->redirect('404');
    }

  }

  public function codeItForContent($arr) {
    $res    = array();
    $ar     = array();
    foreach($arr as $thisArr) {
      $ar = array();
      foreach($thisArr as $k => $val) {
        $ar[$k] = urlencode($val);
      }
      $res[] = $ar;
    }
    return $res;
  }

}
