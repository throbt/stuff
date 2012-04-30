<?php

class User extends Model {
  
  public function getAll($key = '') {
  
    $key    = urldecode(urlencode($key));
    $where  = '';
    
    if($key != '') {
      $where = " where u.name like :name or u.email like :email ";
      $thisParams = new stdClass();
      $thisParams->name = "%{$key}%";
      $thisParams->email = "%{$key}%";
    }
    
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    $queryArr[0]  = "
      select
          count(u.id) as counter
      from
        users u
      join
        users_roles ur
      on
        u.id = ur.uid
      join
        roles r
      on
        ur.role = r.id
      {$where};
    ";
    
    $queryArr[1]  = (isset($thisParams) ? $thisParams : array());
    
    $paginator    = $this->paginator($queryArr,$pagePerItem,$currentPage);
    
    $res = $this->select("
        select
          ur.uid,
          u.email,
          u.name,
          u.psw,
          r.role
        from
          users u
        join
          users_roles ur
        on
          u.id = ur.uid
        join
          roles r
        on
          ur.role = r.id
        {$where}
        {$paginator['limit']};
      ",
      (isset($thisParams) ? $thisParams : array())
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return array(
        'result'  => $res,
        'all'     => $paginator['allPages'],
        'current' => $currentPage
      );
    } else {
      return false;
    }
  }
  
  public function getById($id) {
    $res = $this->select("
        select
          u.*,
          r.id   as role_id,
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
    $md5 = md5($password);
    $this->query("
        update
          users
        set
          password  = ?,
          psw       = ?
        where
          id = ?
      ",
      array($md5,$password,$id)
    );
  }
  
  public function update($id,$role_id) {
    $this->query("
        update
          users_roles
        set
          role = ?
        where
          uid = ?
      ",
      array($role_id,$id)
    );
  }
  
  public function delete($id) {
    $this->query("
        delete
          from
            users_roles
        where
          uid = ?
      ",
      array($id)
    );
    
    $this->query("
        delete
          from
            users
        where
          id = ?
      ",
      array($id)
    );
    
    $this->query("
        delete
          from
            users_domains
        where
          uid = ?
      ",
      array($id)
    );
  }
  
  public function add($email,$password,$name) {
    $this->query("
        insert
          into
            users
        (email,password,psw,name)
          values
        (?,md5(?),?,?);
      ",
      array($email,$password,$password,$name)
    );
    $id = $this->db->lastInsertId();
    return $id;
  }
}

