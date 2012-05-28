<?php

class Langelements_model extends Node {
	
	public function init() {
		$this->className  = $this->getClassName(get_class());
  }

  public function map($elements) {
    $res = array();
    foreach ($elements as $elem) {
      $res[$elem['orig']] = array(
        'hu' => $elem['hu'],
        'en' => $elem['en'],
        'de' => $elem['de']
      );
    }
    return $res;
  }
}
