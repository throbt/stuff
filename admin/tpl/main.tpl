<?php
	global $loader;
	$main = $loader->get('Admin','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang=<?php //echo $_SESSION['language']; ?>hu>
	<head>

		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta http-equiv="format-detection" content="telephone=no" />
		
		<?php echo $main->getHeader(); ?>

		<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		
	</head>
	<body data-offset="50" data-target=".subnav" data-spy="scroll" data-twttr-rendered="true">


		<?php echo $main->getMenu(); ?>


		<div class="container">
			<?php echo $this->var['data']; ?>
		</div>
	</body>
</html>
