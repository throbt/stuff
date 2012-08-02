<?php
	global $loader;
	$main = $loader->get('Admin','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<html lang=<?php echo $_SESSION['language']; ?>>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<?php echo $main->getHeader(); ?>
		<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
	</head>
	<body data-offset="50" data-target=".subnav" data-spy="scroll" data-twttr-rendered="true">


		<?php echo $main->getMenu(); ?>


		<div class="container">
			<?php echo $this->var['data']; ?>
		</div>
	</body>
</html>
