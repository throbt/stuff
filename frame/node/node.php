<?php

class Node extends Model {
	
	function __construct() {
		$this->init();
  }

	public function init() {
  }

  public function getColumns() {
  	return $this->columns;
  }

  public function getFields() {
  	return $this->fields;
  }
}