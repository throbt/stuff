<?php

class Drinks_model extends Node {
	
	public function init() {
		$this->className  = $this->getClassName(get_class());
  }
  
  public function get($id='',$query='') {
		if(gettype($query) == 'array' && $id == '') {
			$result = $this->select(
				$query[0],$query[1]
			);
		} else if((int)$id > 0) {
			$result = $this->select("
				select
				
					d.*,
					i.gallery as gallery,
					i.name as name
					
				from
					drinks d
					
				join
				  images i
			      on
			        d.image = i.id
			    
				where
					d.id = ?;
				",
				array($id)
	    );
		}	/*
				getAll
			*/
			else if($id == '' && $query == '') {
			$result = $this->select("
				select
					*
					from
						{$this->className};
				",
				array()
	    );
		}

		if(isset($result) && $result != null && gettype($result) == 'array') {
			if(count($result) > 0)
				return $result;
		} else {
			return false;
		}
  }
}
