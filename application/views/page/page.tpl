<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="hu-hu" />
    <meta http-equiv="imagetoolbar" content="no" />

    <meta name="author" content="robThot" />

    <link rel='stylesheet' type='text/css' href='/css/bootstrap.css' /> 
    <link rel='stylesheet' type='text/css' href='/css/nivo-slider.css' />
    <link rel='stylesheet' type='text/css' href='/css/bootstrap-responsive.css' />
    <link rel='stylesheet' type='text/css' href='/css/style.css' />
    <script src='/js/jquery.js' type='text/javascript'></script>
    <script src='/js/jquery.nivo.slider.pack.js' type='text/javascript'></script>
    <script src='/js/builder.js' type='text/javascript'></script>
    <script src='/js/slidercfg.js' type='text/javascript'></script>
    <script src='/js/main.js' type='text/javascript'></script>
  </head>
  <body>
			
			<?php
				/*
					page content
				*/
			?>
			<?php print_r($this->var['data']); ?>

      <input type="hidden" id="cfg" value='{"menubar":{"Home":"","Rólunk":"","Cégcsoport":"","Termékek":"","Iparágak":"","active":"Home"},"happeningImages":["/img/bgs/bg2.jpg","/img/bgs/bg1.jpg","/img/bgs/bg3.jpg","/img/bgs/bg4.jpg","/img/bgs/bg5.jpg","/img/bgs/bg6.jpg"]}' />
      
      

  </body>
</html>