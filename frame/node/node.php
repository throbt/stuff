<?php

class Node extends Model {
	
	function __construct() {
		$this->init();
  }

	public function init() {
  }

  public function getColumns() {
  	return array(
  		'title' => 'varchar',
  		'lead' 	=> 'varchar',
  		'body' 	=> 'text',
		);
  }

  public function getFields() {
  	return array(
  		'title' => 'text',
  		'lead' 	=> 'text',
  		'body' 	=> 'testarea',
		);
  }
}