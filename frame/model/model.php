<?php

class Model {

  function __construct() {
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
    $sth->execute();
  }

	public function getClassName($className) {
		if(preg_match('/_/',$className)) {
			preg_match('/(^.*)(_)/',$className,$matches);
			return $matches[1];
		} else {
			return $className;
		}
	}

	public function get() {
  	
  }

	public function create() {
  
  }

	public function update() {
  
  }

	public function delete() {
  
  }
  
  // public function paginator($queryArr = array() /*$getAllQuery*/, $pagePerItem,$currentPage) {
  //    $res = $this->select(
  //      $queryArr[0],
  //      $queryArr[1]
  //    );
  //    $all      = $res[0]['counter'];
  //    $allPages = ceil((int)$all/(int)$pagePerItem);
  //    $from     = $currentPage != 0 ? ($currentPage == 1 ? 0 : ((int)$currentPage - 1)*(int)$pagePerItem) : 0;
  //    $count    = (int)$pagePerItem;
  //    $limit    = " limit {$from},{$count} ";
  //    return array(
  //      'allPages'  => $allPages,
  //      'limit'     => $limit
  //    );
  //  }
}
