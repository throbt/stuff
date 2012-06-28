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
}
