<?php

class Usersroles extends Model {

  function __construct() {
    parent::__construct();
  }
  
  public function add($role_id,$uid) {
    $this->db->query("
        insert
          into
            users_roles
        (role,uid)
          values
        ({$role_id},{$uid});
      "
    );
  }
  
  public function updateRole($role_id,$uid) {
    $this->db->query("
        update
          users_roles
        set
          role = 3
        where
          uid = {$uid}
      "
    );
  }
  
}
