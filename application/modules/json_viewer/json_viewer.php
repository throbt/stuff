<?php

class Json_viewer_module extends Module {

  public function init() {
    global $loader;
    $this->loader = $loader;
  }

  public function node_load($node) {
    $nodes = array('main','main_article');
    if(in_array($node['type'],$nodes)) {
      preg_match_all("/\{[^\}]*\}/" , $node['body'], $matches);  //[^\}]
      if(count($matches[0]) > 0) {
        $obj = '';
        foreach($matches[0] as $match) {
          $obj = json_decode($match);
          if(isset($obj->module) && $obj->module == 'button') {
            $btn = "<a id='sbm' href='{$obj->href}' class='btn btn-{$obj->style} json' type='submit'>{$obj->title}</a>";
            $node['body'] = str_replace($match, $btn, $node['body']);
          }
        }
      }
    }
    return $node;
  }

  public function node_save($id,$post) {
    
  }

  public function node_view($node) {
    return $node;
  }

  public function node_new($node) {
    return $node;
  }

  public function node_form($form) {
    return $form;
  }

  public function node_delete($node) {
    return $node;
  }

  public function title() {
    return 'json_viewer';
  }

  public function description() {
    return '(it) Displays view elements by a json cfg';
  }

  public function name_space() {
    return 'json_viewer';
  }
}