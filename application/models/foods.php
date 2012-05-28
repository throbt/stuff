<?php

class Foods_model extends Node {
	
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
				
					f.*,
					i.gallery as gallery,
					i.name as name
					
				from
					foods f
					
				left join
				  images i
			      on
			        f.image = i.id
			    
				where
					f.id = ?;
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
						foods;
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
