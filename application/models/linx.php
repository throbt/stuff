<?php

class Linx_model extends Model {
  
  public function init() {
    $this->className  = $this->getClassName(get_class());
  }
  
  public function getByOrder($order = '') {
    if($order != '') {
      $result = $this->select("
        select
        
          *
          
        from
          linx
          
        where
          `thisorder` = ?;
        ",
        array($order)
      );

      if(isset($result) && $result != null && gettype($result) == 'array') {
        if(count($result) > 0)
          return $result;
      }
    }

    return false;
  }

  public function getByParams($params = '') {
    if($params != '') {
      $result = $this->select("
        select
        
          *
          
        from
          linx
          
        where
          `params` = ?;
        ",
        array($params)
      );

      if(isset($result) && $result != null && gettype($result) == 'array') {
        if(count($result) > 0)
          return $result[0]['thisorder'];
      }
    }
    return '';
  }

  public function insertLink($order = '',$params = '') {
    if($order != '' && $params != '') {
      $result = $this->select("
        select
        
          count(*) as counter
          
        from
          linx
          
        where
          `params` = ?;
        ",
        array($params)
      );

      if((int)$result[0]['counter'] > 0) {
        $this->query("
          update
            linx
              set
                `thisorder` = ?
          where
            `params` = ?
        ",array($order,$params));
      } else {
        $this->query("
          insert into linx(`thisorder`,`params`) values(?,?)
        ",array($order,$params));
      }
    }
  }
}
