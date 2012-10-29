<?php
  global $loader;
  $main = $loader->get('Test','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <!-- <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/imfavicon.ico" type="image/x-icon"> -->
    <?php echo $main->getHeader(); ?>
  </head>
  <body class="<?php //echo $main->getRoute(); ?>">
    <div id="page_container">
          <?php //echo $main->getPageHeader(); ?>
        
          <?php
            /*
              page content
            */
          ?>
          <div class="container">
            <?php echo $this->var['data']; ?>
          </div>
          
          <?php echo $main->getPageFooter(); ?>
          
    </div>
  </body>
</html>