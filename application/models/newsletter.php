<?php

class Newsletter_model extends Node {
  
  public function init() {
    $this->className  = $this->getClassName(get_class());
  }
}