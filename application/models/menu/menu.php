<?php

class Menu_model extends Model {
	
	public function init() { 
    $this->className = strtolower($this->getClassName(get_class()));  
  }


}