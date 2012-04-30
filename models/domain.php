<?php

class Domain extends Model {
  
  public function getDirs() {
    $dirs = array();
    $res = $this->select("
        select
          distinct(dir)
        from
          domains;
      "
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      foreach($res as $dir) {
        $dirs[] = $dir['dir'];
      }
      return $dirs;
    } else {
      return false;
    }
  }
  
  public function dirState($id) {
    $arr      = $this->get($id);
    $thisDir  = "{$arr[0]['dir']}/";
    
    if(file_exists(DOMAINS.$thisDir.'builded'))
      return true;
    else
      return false;
  }
  
  public function getDomainForOwner($id) {
    $res = $this->select("
        select
          *
        from
          domains
        where
          id in(
        
          select
            domain_id
          from
            users_domains
          where
            uid = ?
        
        )
        and id = ?;
      ",
      array($_SESSION['sessionUser']->id,$id)
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res;
    } else {
      return false;
    }
  }
  
  public function get($id) {
    $res = $this->select("
        select
          *
        from
          domains
        where
          id = ?
        order by domain asc;
      ",
      array($id)
    );
    
    if(gettype($res) == 'array' && count($res) > 0) {
      return $res;
    } else {
      return false;
    }
  }
  
  public function getByOwner() {
    $res = $this->select("
        select
          *
        from
          domains d
        join
          users_domains ud
        on d.id = ud.domain_id
        where
          ud.uid = ?;
      ",
      array($_SESSION['sessionUser']->id)
    );
    
    if(gettype($res) == 'array') {
      return $res;
    } else {
      return false;
    }
  }
  
  public function getAll() {
    
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    $queryArr[0]  = "
      select
          count(*) as counter
        from
      domains;
    ";
    $queryArr[1] = array();
    
    $paginator = $this->paginator($queryArr, $pagePerItem,$currentPage);
  
    $res = $this->select("
        select
          *
        from
          domains
        order by domain asc
        {$paginator['limit']};
      "
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
  
  public function update($domain,$dir,$id) {
    $this->query("
      update
        domains
      set
        domain  = ?,
        dir     = ?
      where
        id = ?;
    ",
    array($domain,$dir,$id)
    );
  }
  
  public function add($domain,$dir) {
    $this->query("
        insert
          into
            domains
        (domain,dir)
          values
        (?,?);
      ",
    array($domain,$dir)    //mysql_escape_string
    );
  }
  
  public function delete($id) {
    $this->query("
        delete
          from
            domains
        where
          id = ?;
      ",
      array($id)
    );
    $this->query("
        delete
          from
            users_domains
        where
          domain_id = ?;
      ",
      array($id)
    );
  }
  
  public function getSearchResult($key) {
  
    $currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagePerItem  = $this->pagePerItem;
    
    $queryArr = array(
      "
      select
          count(*) as counter
        from
      domains
        where
          domain like ?;
      ",
      array("%{$key}%")
    );
    
    $paginator = $this->paginator($queryArr, $pagePerItem,$currentPage);
  
    $res = $this->select("
        select
          *
        from
          domains
        where
          domain like ?
        order by domain asc
        {$paginator['limit']};
      ",
      array("%{$key}%")
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
}
