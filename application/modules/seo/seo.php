<?php

class Seo_module extends Module {

  public function init() {
    global $loader;
    $this->loader = $loader;

    $this->linx = $this->loader->get('Linx','model');
    $this->types = array('main_article');
  }

  public function node_load($node) {
    if(in_array($node['type'],$this->types)) {
      $taxModel     = $this->loader->get('Taxonomy');
      $thisTerm     = $taxModel->term_load($node['main_group']);
      $thisParam    = "{$node['type']}/{$node['id']}";
      $thisOrder    = $this->linx->getByParams($thisParam);
      $node['seo']  = ($thisOrder == '' ? $thisParam : $thisOrder);
    }
    return $node;
  }

  public function node_save($id,$post) {
    $nodeModel  = $this->loader->get('Node');
    $taxModel   = $this->loader->get('Taxonomy');
    $thisNode   = $nodeModel->node_load($id);
    $thisTerm   = $taxModel->term_load($thisNode['main_group']);
    if(in_array($post['type'],$this->types)) {
      $thisParam = "{$thisTerm['name']}/{$id}";
      $thisOrder = $post['seo'];
      $this->linx->insertLink($thisOrder,$thisParam);
    }
  }

  public function node_view($node) {
    $taxModel   = $this->loader->get('Taxonomy');
    $thisTerm   = $taxModel->term_load($node['main_group']);
    if($node['type'] == 'main_article') {
      $thisParam = "{$thisTerm['name']}/{$node['id']}";
      $thisOrder = $this->linx->getByParams($thisParam);
      if(isset($node['form']['form'])) {
          $thisForm   = $node['form'];
        } else {
          $nodeModel  = $this->loader->get('Node');
          $thisForm   = $nodeModel->node_form($node['type']);
        }

      foreach($thisForm['elements'] as $k => $el) {
        if(isset($el['name'])) {
          if($el['name'] == 'seo') {
            $thisForm['elements'][$k]['value'] = ($thisOrder == '' ? "/{$thisParam}" : "/{$thisOrder}");
          }
          if($el['name'] == 'landing') {
            $thisForm['elements'][$k]['value'] = ($thisOrder == '' ? "/{$thisParam}/landing" : "/m/{$thisOrder}/landing");
          }
          if($el['name'] == 'mobile') {
            $thisForm['elements'][$k]['value'] = ($thisOrder == '' ? "/m/{$thisParam}" : "/m/{$thisOrder}");
          }
        }
      }
      $node['form'] = $thisForm;
    }
    return $node;
  }

  public function node_new($node) {
    return $node;
  }

  public function node_form($form) {
    $form_id = $form['form']['id'];
    switch($form_id) {
      case 'node_main_article':
        array_unshift($form['elements'],array(
          'type'  => 'text',
          'label' => 'seo url',
          'id'    => 'seo',
          'class' => 'input-xlarge big',
          'name'  => 'seo'
        ));
      break;
      case 'node_main':
        array_unshift($form['elements'],array(
          'type'  => 'text',
          'label' => 'seo url',
          'id'    => 'seo',
          'class' => 'input-xlarge big',
          'name'  => 'seo'
        ));
      break;
    }
    return $form;
  }

  public function node_delete($node) {
    return $node;
  }

  public function title() {
    return 'seo';
  }

  public function description() {
    return 'seo description';
  }

  public function name_space() {
    return 'seo';
  }
}