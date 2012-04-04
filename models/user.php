<?php

class User extends Model {

#  function __construct() {
#    parent::__construct();
#  }
  
  public function getAll() {
    $res = $this->select("
        select
          *
        from
          users u
        join
          users_roles ur
        on
          u.id = ur.uid
        join
          roles r
        on
          ur.role = r.id;
      "
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res;
    } else {
      return false;
    }
  }
  
  public function getById($id) {
    $res = $this->select("
        select
          u.*,
          r.id    as role_id,
          r.role as role
        from
          users u
        left join
          users_roles ur
        on
          u.id = ur.uid
        left join
          roles r
        on
          r.id = ur.role
        where
          u.id = ?;
      ",
      array($id)
    );
     
    if(gettype($res) == 'array' && count($res) > 0) {
      $thisRes = new stdClass();
      foreach($res[0] as $k => $v) {
        $thisRes->$k = $v;
      }
      return $thisRes;
    } else {
      return false;
    }
  }
  
  public function getByForm($email,$password) {
    $psw = md5($password);
    
    $res = $this->select("
        select
          u.*,
          r.id    as role_id,
          r.role as role
        from
          users u
        left join
          users_roles ur
        on
          u.id = ur.uid
        left join
          roles r
        on
          r.id = ur.role
        where
          u.email = ?
        and
          u.password = ?;
      ",
      array($email,$psw)
    );
     
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res[0];
    } else {
      return false;
    }
  }
  
  public function changePassword($password,$id) {
    $this->query("
        update
          users
        set
          password = ?
        where
          id = ?
      ",
      array($password,$id)
    );
  }
  
  public function add($email,$password,$name) {
    $this->query("
        insert
          into
            users
        (email,password,name)
          values
        (?,?,?);
      ",
      array($email,$password,$name)
    );
    $id = $this->db->lastInsertId();
    return $id;
  }
}

