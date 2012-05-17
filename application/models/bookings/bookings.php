<?php

class Bookings_model extends Node {
	
	public function init() {
    
		$this->className  = $this->getClassName(get_class());

#    $this->columns    = array(
#      'title' => 'varchar',
#      'lead'  => 'varchar',
#      'body'  => 'text'
#    );
#    $this->fields     = array(
#      'title' => 'text',
#      'lead'  => 'text',
#      'body'  => 'textarea'
#    );
  }
}
