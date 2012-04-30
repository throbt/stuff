<?php

class Usersdomain extends Model {
  
  public function get($id) {
    $res = $this->select("
        select
          ud.*,
          ud.id as udid,
          d.domain,
          d.id
        from
          users_domains ud
        left join
          domains d
        on d.id = ud.domain_id
        where
          ud.uid = ?;
      ",
      array($id)
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res;
    } else {
      return false;
    }
  }
  
  public function delete($profileId) {
    $this->query("
        delete
          from
            users_domains
        where
          id = ?;
      ",
      array($profileId)
    );
  }
  
  public function add($domainId,$profileId) {
    $this->query("
        insert
          into
            users_domains
          (domain_id,uid)
        values
          (?,?);
      ",
      array($domainId,$profileId)
    );
  }
  
  public function getDomains($profileId) {
    $res = $this->select("
        select
          *
        from
          domains d
        where
          d.id not in(
            select
              distinct(domain_id)
            from
              users_domains
            where uid = {$profileId}
          );
      ",
      array()
    ); //print_r($res);
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res;
    } else {
      return false;
    }
  }
}
