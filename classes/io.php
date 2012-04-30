<?php

class getIo {
  public function &get($scope = '') {
    static $obj;
    if (!is_object($obj)){
      $obj = new Io($scope);
    }
    return $obj;
  }
}

class Io {

  function __construct($scope = '') {
    $this->scope = $scope;
  }
  
  public function rrmdir($dir) {
    if(is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }
}
