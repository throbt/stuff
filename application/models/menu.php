<?php

class Menu_model extends Model {
	
	public function init() { 
    $this->className = strtolower($this->getClassName(get_class()));  
  }

  // public function getAll($query) {
  //   return $this->get(
  //     '',
  //     array(
  //       $query[0],
  //       $query[1]
  //     )
  //   );
  // }

}