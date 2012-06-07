	<?php 
	ini_set('include_path', '/home/vvv/sites/evoline/frame');
	require_once('config/config.php');
	require_once('loader/loader.php');
	
	$config = getConfig::get(dirname(__FILE__).'/../config/application.ini'); //print_r($config);
	
	ini_set('display_errors',$config->cfg['display_errors']);
	
	session_start();

	$loader 	= getLoader::get();
	$stuff 		= $loader->get('Stuff');
	$session 	= $loader->get('Session');
	$router 	= $loader->get('Router');
  
?>
