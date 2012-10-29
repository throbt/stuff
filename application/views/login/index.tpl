<?php
	global $loader;
	$main = $loader->get('Main','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<html lang=<?php echo $_SESSION['language']; ?>>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<?php echo $main->getHeader(); ?>
	</head>
	<body data-offset="50" data-target=".subnav" data-spy="scroll" data-twttr-rendered="true">
		
		
		
		<h1>&nbsp;</h1>
		<h1>&nbsp;</h1>
		<h1>&nbsp;</h1>
		
		<div class="container">
			<?php echo $this->var['data']; ?>
		</div>
	</body>
</html>
