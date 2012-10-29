<?php

class Mobile {

  function __construct() {
    require_once('Mobile_Detect.php');
    $this->detect = new Mobile_Detect();
  }

  public function detect() {
    return $this->detect->isMobile();
  }
}
