<?php

class Model {

  function __construct() {
		global $stuff;
		$this->stuff = $stuff;
    require_once('db/db.php');
    $this->db = getPDO::get();
    $this->db->query("set names 'utf8'");
		$this->init();
  }

	public function init() {
  }
  
	public function select($query,$params = array()) {
    $sth = $this->db->prepare($query);  
    if(gettype($params) == 'array') {
      foreach($params as $index => $param) {
        $sth->bindValue(($index+1),$param);
      }
    } else if(gettype($params) == 'object'){
      foreach($params as $index => $param) {
        $sth->bindValue(":{$index}",$param);
      }
    }
    $sth->execute(); //print_r($sth->errorinfo());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function query($query,$params = array()) {
    $sth = $this->db->prepare($query);
    foreach($params as $index => $param) {
      $sth->bindValue(($index+1), $param);
    }
    $sth->execute(); //print_r($sth->errorinfo());
  }

	public function getClassName($className) {
		if(preg_match('/_model/',$className)) {
			preg_match('/[^_]*/',$className,$matches);
			return strtolower($matches[0]);
		} else {
			return strtolower($className);
		}
	}
	
	/*
		@get method
		
		@id {integer}
		@query (array) {
			0 => {string(sql)},
			1 => {array}
		}
	*/
	public function get($id,$query='') {
		if(gettype($query) == 'array' && $id == '') {
			$result = $this->select(
				$query[0],$query[1]
			);
		} else if((int)$id > 0) {
			$result = $this->select("
				select
					*
					from
						{$this->className}
					where
						id = ?;
				",
				array($id)
	    );
		}
		if(isset($result) && $result != null && gettype($result) == 'array') {
			if(count($result) > 0)
				return $result;
		} else {
			return false;
		}
  }

	/*
		@create method
		
		@column (array) {column => value pairs}
		@query (array) {
			0 => {string(sql)},
			1 => {array}
		}
	*/
	public function create($columns='',$query='') {
  	if(gettype($query) == 'array' && $columns == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if(gettype($columns) == 'array') {
			$keys 	= implode(',',array_keys($columns));
			$arr 		= array();
			$values = array();
			foreach($columns as $key => $column) {
				$arr[] 		= '?';
				$values[] = $column;
			}
			$vals 	= implode(',',$arr);
			$this->query("
					insert
						into
							{$this->className}
					({$keys})
						values({$vals});
				",
				$values
			);
		}
  }

	/*
		@update method
		
		@id {integer}
		@column (array) {column => value pairs}
		@query (array) {
			0 => {string(sql)},
			1 => {array}
		}
	*/
	public function update($id='',$columns='',$query='') {
  	if(gettype($query) == 'array' && $columns == '' && $id == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if((int)$id > 0 && gettype($columns) == 'array' && $query == '') {
			$expression = '';
			$values 		= array();
			foreach(array_keys($columns) as $key) {
				$expr 			.= " {$key} = ?, ";
				$values[] 	 = $columns[$key];
			}
			$expr = substr($expr, 0, strlen($expr) - 2) . ' ';
			$this->query("
					update
						{$this->className}
					set
						{$expr}
					where
						id = ?;
				",
				$values
			);  
		}
  }
	
	/*
		@delete method
		
		@id {integer}
		@query (array) {
			0 => {string(sql)},
			1 => {array}
		}
	*/
	public function delete($id='',$query='') {
  	if(gettype($query) == 'array' && $id == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if((int)$id > 0) {
			$this->query("
				delete
					from
						{$this->className}
				where
					id = ?;
				",
				array($id)
			);
		}
  }
}
