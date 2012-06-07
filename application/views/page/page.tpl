<?php
  global $loader;
  $main = $loader->get('Main','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php echo $main->getHeader(); ?>
  </head>
  <body>
			
			<?php
				/*
					page content
				*/
			?>

      <?php echo $main->getCfg(); ?>

			<?php print_r($this->var['data']); ?>  <!-- "/upload/25/0fcdc0350faa3cc3cfdec31d4d1ed4ca.jpg"  ["/img/bgs/bg2.jpg","/img/bgs/bg1.jpg","/img/bgs/bg3.jpg","/img/bgs/bg4.jpg","/img/bgs/bg5.jpg","/img/bgs/bg6.jpg"]-->

      <!-- <input type="hidden" id="cfg" value='{"menubar":{"Home":"","Rólunk":"","Cégcsoport":"","Termékek":"","Iparágak":"","active":"Home"},"happeningImages":["/img/bgs/bg2.jpg","/img/bgs/bg1.jpg","/img/bgs/bg3.jpg","/img/bgs/bg4.jpg","/img/bgs/bg5.jpg","/img/bgs/bg6.jpg"]}' /> -->
      
      

  </body>
</html>