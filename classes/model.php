<?php

class Model {

  function __construct() {
    require_once(CLASSES . 'db.php');
    $this->db = getPDO::get();
    $this->db->query("set names 'utf8'");
    $this->pagePerItem = 10;
  }
  
  /*
    (read|write|global|personal)
    ({role_id}|{role_id}|{true/false}|{true/false})
  */
  public function access() {
  
  }
  
  public function paginator($queryArr = array() /*$getAllQuery*/, $pagePerItem,$currentPage) {
    $res = $this->select(
      $queryArr[0],
      $queryArr[1]
    );
    $all      = $res[0]['counter'];
    $allPages = ceil((int)$all/(int)$pagePerItem);
    $from     = $currentPage != 0 ? ($currentPage == 1 ? 0 : ((int)$currentPage - 1)*(int)$pagePerItem) : 0;
    $count    = (int)$pagePerItem;
    $limit    = " limit {$from},{$count} ";
    return array(
      'allPages'  => $allPages,
      'limit'     => $limit
    );
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
}
