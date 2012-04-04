<?php

class Route extends Model {

  function __construct() {
    parent::__construct();
    $this->notMenuRoutes  = array(
      'profile',
      'login',
      'login/process',
      'login/logout'
    );
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
      return array($arr,$res);
    } else {
      return false;
    }
  }
}
