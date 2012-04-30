<?php
	ini_set('include_path', '/Users/robThot/sites/engine/frame/');
	require_once('config/config.php');
	$config = getConfig::get(dirname(__FILE__) . '/../application/config/application.ini');

  error_reporting(E_ALL);
  ini_set('display_errors','On');
  
  //session_start();
  
  /*require_once('../classes/loader.php');
  $loader = getLoader::get();
  $router = $loader->get('Router','class');*/
  
?>
