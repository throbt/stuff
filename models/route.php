<?php

class Route extends Model {

  function __construct() {
    parent::__construct();
    $this->notMenuRoutes  = array(
      'profile',
      'login',
      'login/process',
      'login/logout',
      'usersdomains',
      'ajax',
      'linkto'
    );
  }
  
  public function add($route,$name) {
    $this->query("
        insert
          into
            route_access
        (route,name,role_id)
          values
        (?,?,1);
      ",
    array($route,$name)
    );
  }
  
  public function update($id,$role,$routeName) {
    $this->query("
        update
          route_access
        set
          role_id = ?,
          name    = ?
        where
          id = ?;
      ",
    array($role,$routeName,$id)
    );
  }
  
  public function delete($id) {
    $this->query("
        delete
          from
        route_access
        where
          id = ?;
      ",
    array($id)
    );
  }
  
  public function getAll($key = '') {
  
    $key    = urldecode(urlencode($key));
    $where  = '';
    
    if($key != '') {
      $where = " where ra.route like :route or ra.name like :name ";
      $thisParams = new stdClass();
      $thisParams->route = "%{$key}%";
      $thisParams->name = "%{$key}%";
    }
    
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    $queryArr[0]  = "
      select
          count(ra.id) as counter
        from
          route_access ra
        join
          roles r
        on ra.role_id = r.id;
      {$where};
    ";
    
    $queryArr[1]  = (isset($thisParams) ? $thisParams : array());
    
    $paginator    = $this->paginator($queryArr,$pagePerItem,$currentPage);
  
    $res = $this->select("
        select
          ra.id,
          ra.route,
          ra.name,
          ra.role_id,
          r.role
        from
          route_access ra
        join
          roles r
        on ra.role_id = r.id
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
    
  
  
  public function get($role_id) {
    $res = $this->select("
        select
          *
        from
          route_access
        where
          role_id >= ?;
      ",
      array($role_id)
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      $arr = array();
      foreach($res as $k => $r) {
        $arr[] = $r['route'];
        if(in_array($r['route'],$this->notMenuRoutes)) {
          unset($res[$k]);
        }
      }
      return array($arr,$res,$this->notMenuRoutes);
    } else {
      return false;
    }
  }
}
