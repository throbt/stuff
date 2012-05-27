<?php

class Newsletter_emails_model extends Node {
  
  public function init() {
    $this->className  = 'newsletter_emails';
  }

  public function get($id='',$query='') {
    if(gettype($query) == 'array' && $id == '') {
      $result = $this->select(
        $query[0],$query[1]
      );
    } else if((int)$id > 0) {
      $result = $this->select("
        select
        
          d.*,
          i.gallery as gallery,
          i.name as name
          
        from
          newsletter_emails d
          
        left join
          images i
            on
              d.image = i.id
          
        where
          d.id = ?;
        ",
        array($id)
      );
    } /*
        getAll
      */
      else if($id == '' && $query == '') {
      $result = $this->select("
        select
          *
          from
            newsletter_emails;
        ",
        array()
      );
    }

    if(isset($result) && $result != null && gettype($result) == 'array') {
      if(count($result) > 0)
        return $result;
    } else {
      return false;
    }
  }
}