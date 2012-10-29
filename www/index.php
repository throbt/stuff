	<?php error_reporting(E_ALL);
	
	/*
	 *	M N V C - written by throbt(throbt@gmail.com)
	 *	licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
	 */

	ini_set('include_path', '/home/vvv/sites/mnvc/frame');

	require_once('config/config.php');
	require_once('loader/loader.php');

	$config = getConfig::get(dirname(__FILE__).'/../application/config/application.ini');

	error_reporting(((int)$config->cfg['display_errors'] == 1 ? E_ALL : NULL));
	ini_set('display_errors',(int)$config->cfg['display_errors']);

	session_start();

	$loader 	= getLoader::get();
	$stuff 		= $loader->get('Stuff');
	$session 	= $loader->get('Session');
	$router 	= $loader->get('Router');
