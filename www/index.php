	<?php

	error_reporting(E_ALL);
  ini_set('display_errors','On');

	ini_set('include_path', '/var/www/halation.hu/f40.halation.hu/www/f41.halation.hu/frame');
	require_once('config/config.php');
	require_once('loader/loader.php');

	$config = getConfig::get(dirname(__FILE__).'/../config/application.ini');

	ini_set('display_errors',$config->cfg['display_errors']);

	session_start();

	$loader 	= getLoader::get();
	$stuff 		= $loader->get('Stuff');
	$session 	= $loader->get('Session');
	$router 	= $loader->get('Router');

?>
