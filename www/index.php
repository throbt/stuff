<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  
  session_start();

  require_once('../classes/loader.php');
  $loader = getLoader::get();
  $router = $loader->get('Router','class');
  
?>
