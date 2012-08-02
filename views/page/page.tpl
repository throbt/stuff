<?php
  global $loader;
  $main = $loader->get('Main','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<html>
  <head>

    <link rel="icon" type="image/png" href="/img/favicon.ico" />

    <?php echo $main->getHeader(); ?>
  </head>
  <body>
			<?php
				/*
					page content
				*/
			?>
<?php echo $main->getCfg(); ?>
<?php echo $this->var['data']; ?>


    <img src="/img/footer/microsoft-gold-partner.png" style="display:none;" />
    <img src="/img/footer/microsoft-gold-partner-hover.png" style="display:none;" />
    <img src="/img/footer/iso.png" style="display:none;" />
    <img src="/img/footer/iso-hover.png" style="display:none;" />
    <img src="/img/footer/oracle-certified-expert.png" style="display:none;" />
    <img src="/img/footer/oracle-certified-expert-hover.png" style="display:none;" />
    <img src="/img/footer/oracle-gold-partner.png" style="display:none;" />
    <img src="/img/footer/oracle-gold-partner-hover.png" style="display:none;" />
    <img src="/img/footer/sap.png" style="display:none;" />
    <img src="/img/footer/sap-hover.png" style="display:none;" />
    <img src="/img/footer/salt_logo-01.png" style="display:none;" />
    <img src="/img/footer/salt_logo-hover-01.png" style="display:none;" />
  </body>
</html>
