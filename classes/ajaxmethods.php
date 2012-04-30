<?php

class Ajaxmethods {

  function __construct() {
  }
  
  public function build($scope) {
    $obj    = $scope->router->loader->get('Domain','model');
    $domain = $obj->get($_POST['id']);
    $dir    = $domain[0]['dir'];
    
    $thisDir = DOMAINS.$dir.'/www/';
    if(is_dir($thisDir)) {
      $this->rrmdir($thisDir);
    }
    
    if(!is_dir(DOMAINS.$dir)) {
      mkdir(DOMAINS."{$dir}",0777);
    }

    shell_exec("cp ".SAMPLE.SAMPLEFILE." ".DOMAINS."{$dir}/".SAMPLEFILE."; cd ".DOMAINS."{$dir}/; gunzip ".SAMPLEFILE."; tar xf sample.tar; rm sample.tar; touch builded;");
  }
  
  public function delete($scope) {
    $obj      = $scope->router->loader->get('Domain','model');
    $domain   = $obj->get($_POST['id']);
    $dir      = $domain[0]['dir'];
    
    $this->io = $this->router->loader->get('Io','class');
    
    if(is_dir(DOMAINS."{$dir}"))
      $this->io->rrmdir(DOMAINS."{$dir}");
      
    $obj->delete($_POST['id']);
  }
}
