<?php

class Model {
  function __construct() {
    require_once(CLASSES . 'db.php');
    $this->db = getPDO::get();
    $this->db->query("set names 'utf8'");
    $this->pagePerItem = 10;
  }
  
  public function select($query,$params = array()) {
    $sth = $this->db->prepare($query);
    foreach($params as $index => $param) {
      $sth->bindValue(($index+1), $param);
    }
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function query($query,$params = array()) {
    $sth = $this->db->prepare($query);
    foreach($params as $index => $param) {
      $sth->bindValue(($index+1), $param);
    }
    $sth->execute();
  }
  
  public function paginator($getAllQuery, $pagePerItem,$currentPage) {
  
    $res = $this->db->query(
      $getAllQuery
    )->fetchAll(PDO::FETCH_ASSOC);
    
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
}
