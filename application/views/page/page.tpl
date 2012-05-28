<?php //print_r($this->var['scope']->router);
	global $loader;
	$main 				= $loader->get('Main','helper',$this->var['scope']);
	$langMod 			= $loader->get('Langelements','model');
	$thisLang 		= $_SESSION['language'];
 	$lang 				= $langMod->map($langMod->get(
    '',
    array(
      '
        select
          *
          from
            langelements
            
        where
          type = "page";
      ',
      array()
    )
  ));

	// <!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> -->
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  	<meta http-equiv="Content-Language" content="hu-hu" />
  	<meta http-equiv="imagetoolbar" content="no" />
		<?php echo $main->getHeader(); ?>
	</head>
	<body>
		<div id="headerWrapper">
			<div id="topBarCont">
				<div id="topBar">
					<div id="topBarMenu">
						<p id="topBarLeftSide">
							<a href="/<?php echo $this->var['scope']->router->link("bookings"); ?>" id="aBooking"><?php echo $lang['booking'][$thisLang]; ?></a>
							<a href="/<?php echo $this->var['scope']->router->link("newsletter"); ?>" id="aNewsletter"><?php echo $lang['newsletter'][$thisLang]; ?></a>
						</p>
						<p id="topBarRightSide">
							<a id="hu" href="" onclick="return false;" class="langLink">HU</a>
								|
							<a id="en" href="" onclick="return false;" class="langLink">EN</a>
								|
							<a id="de" href="" onclick="return false;" class="langLink">DE</a>
						</p>
					</div>
				</div>
			</div>
			<div id="topBannerCont">
				<div id="topBanner" class="nivoSlider">

					<?php echo $main->getSliderImages(); ?>

				</div>
			</div>
			<div id="menuWrapperCont">
				<div id="menuWrapper">
					<?php echo $main->getMenu(); ?>
				</div>
			</div>
			<div id="titleBarCont">
				<div id="titleBar"></div>
			</div>
		</div>

		<div id="bodyWrapper">
			<div id="bodyContainer">
				<div id="content">
					<?php echo $this->var['data']; ?>
				</div>
				<div id="sider">
					<?php echo $main->getSider(); ?>
				</div>
			</div>
		</div>

		<div id="footerWrapper">
			<?php echo $main->getFooter(); ?>
		</div>
	
  <div id="logoWrapper">
  	<div id="logoCont">
  	</div>
  </div>


	</body>
</html>