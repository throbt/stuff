<?php

class Module {
  
  function __construct() {
    global $stuff;
    global $config;
    global $loader;
    $this->loader = $loader;
    $this->config = $config;
    $this->stuff  = $stuff;

    $this->init();
  }

  public function init() {
  }

  public function get() {

    require_once(CONFIG.'modules.cfg');
    $modules  = (isset($modules) ? json_decode($modules) : array());

    $formEls  = array();
    $dRes     = array();
    $api      = array('node_load','node_save','node_view','node_new','node_delete','node_form');
    $methods  = array();
    $file     = '';
    $dirs     = scandir(MODULES);
    foreach($dirs as $dir) {
      if($dir != '.' && $dir != '..') {
        $file       = MODULES.$dir.DIRECTORY_SEPARATOR."{$dir}.php";
        $className  = ucfirst($dir) . '_module';
        if(file_exists($file)) {
          require_once($file);
          $dRes[$dir]['title']        = $className::title();
          $dRes[$dir]['description']  = $className::description();
          $dRes[$dir]['namespace']    = $className::name_space();
          $dRes[$dir]['api']          = array();
          $methods = get_class_methods("{$dir}_module");
          foreach ($methods as $method) {
            if(in_array($method,$api)) {
              if(isset($modules->$dir->$method))
                $dRes[$dir]['api'][$method] = $modules->$dir->$method;
              else
                $dRes[$dir]['api'][$method] = 0;
            }
          }
        }
      }
    }
    return $dRes;
  }

  public function title() {}

  public function description() {}

  public function name_space() {}
}