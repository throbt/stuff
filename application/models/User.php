<?php

class Application_Model_User extends Zend_Db_Table_Abstract {
  
  protected $_name = 'user';
  
  public function getUser($username){
    $result = $this->_db->query(
      "select * from user where username = ?",
      array($username)
    )->fetchAll();
    
    if(count($result) > 0)
      return $result[0];
    else
      return 0;
    
    /*$row  = $this->fetchRow('username = ' . $username);
    if (!$row) {
        throw new Exception("Could not find row $id");
    }
    return $row->toArray();*/
  }
  
  public function getProfile($mid, $group_id) {
    $result = $this->_db->query("
      select
        *
      from 
        members m
      where
        m.id = ? and m.group_id = ?;
      ",
      array($mid, $group_id)
    )->fetchAll(); 
    
    return $result;
  }
}