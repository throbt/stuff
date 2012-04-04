<?php

class Domain extends Model {
  
  public function getDirs() {
    $dirs = array();
    $res = $this->db->query("
        select
          distinct(dir)
        from
          domains;
      "
    )->fetchAll(PDO::FETCH_ASSOC);
    
    if(gettype($res) == 'array' && count($res) > 0) {
      foreach($res as $dir) {
        $dirs[] = $dir['dir'];
      }
      return $dirs;
    } else {
      return false;
    }
  }
  
  public function getAll() {
    
#    $r = $this->select("
#      select
#          *
#        from
#      domains
#        where
#      dir like ?
#        or
#      dir like ?;
#    ",array('%f41.halation%','%f42.halatio%'));
#    
#    print_r($r); //die();
    
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    $getAllQuery  = "
      select
          count(*) as counter
        from
      domains;
    ";
    
    $paginator = $this->paginator($getAllQuery, $pagePerItem,$currentPage);
  
    $res = $this->db->query("
        select
          *
        from
          domains
        {$paginator['limit']};
      "
    )->fetchAll(PDO::FETCH_ASSOC);
    
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
  
  public function update($domain,$dir,$id) {
    $this->db->query("
        update
          domains
        set
          domain  = '{$domain}',
          dir     = '{$dir}'
        where
          id = {$id};
      "
    );
  }
  
  public function add($domain,$dir) {
    $this->db->query("
        insert
          into
            domains
        (domain,dir)
          values
        ('{$domain}','{$dir}');
      "
    );
  }
  
  public function delete($id) {
    $this->db->query("
        delete
          from
            domains
        where
          id = {$id};
      "
    );
  }
  
  public function getSearchResult($key) {
  
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    $getAllQuery  = "
      select
          count(*) as counter
        from
      domains
        where
          (domain like '%{$key}%' || dir like '%{$key}%');
    ";
    
    $paginator = $this->paginator($getAllQuery, $pagePerItem,$currentPage);
  
    $res = $this->db->query("
        select
          *
        from
          domains
        where
          (domain like '%{$key}%' || dir like '%{$key}%')
        {$paginator['limit']};
      "
    )->fetchAll(PDO::FETCH_ASSOC);
    
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
}
