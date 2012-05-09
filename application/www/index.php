<?php
	
	ini_set('include_path', '/home/v/sites/engine/frame');
	
	require_once('config/config.php');
	require_once('loader/loader.php');
	
	$config = getConfig::get(dirname(__FILE__).'/../config/application.ini');
	
	ini_set('display_errors',$config->cfg['display_errors']);
	
	$loader = getLoader::get();
	$stuff 	= $loader->get('Stuff');
	$router = $loader->get('Router');
  
?>
