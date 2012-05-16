<?php

class Profile_model extends Model {
  
  public function init() {
    $this->className = strtolower($this->getClassName(get_class()));
  }

  public function getAll() {
    
  }

  public function getProfile($email,$pass) {
    $profile = $this->get(
      '',
      array(
        '
          select

            u.*,
            r.role,
            r.id as rid

            from
              users u

            join roles r
              on
                u.role = r.id

          where
            u.email = ?
          and
            u.password = ?;
        ',
        array($email,$pass)
      )
    );
    if($profile)
      return $profile[0];
    else
      return $profile;
  }   

}