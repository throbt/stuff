<?php
	global $loader;
	$main = $loader->get('Main','helper',$this->var['scope']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  	<meta http-equiv="Content-Language" content="hu-hu" />
  	<meta http-equiv="imagetoolbar" content="no" />
		<?php echo $main->getHeader(); ?>
		<script type="text/javascript">
	    $(window).load(function() {
	         $('#topBanner').nivoSlider({
		        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
		        slices: 15, // For slice animations
		        boxCols: 8, // For box animations
		        boxRows: 4, // For box animations
		        animSpeed: 500, // Slide transition speed
		        pauseTime: 3000, // How long each slide will show
		        startSlide: 0, // Set starting Slide (0 index)
		        directionNav: true, // Next & Prev navigation
		        directionNavHide: true, // Only show on hover
		        controlNav: false, // 1,2,3... navigation
		        controlNavThumbs: false, // Use thumbnails for Control Nav
		        controlNavThumbsFromRel: false, // Use image rel for thumbs
		        controlNavThumbsSearch: '.jpg', // Replace this with...
		        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
		        keyboardNav: true, // Use left & right arrows
		        pauseOnHover: true, // Stop animation while hovering
		        manualAdvance: false, // Force manual transitions
		        captionOpacity: 0.8, // Universal caption opacity
		        prevText: 'Vissza', // Prev directionNav text
		        nextText: 'Tovább', // Next directionNav text
		        randomStart: false, // Start on a random slide
		        beforeChange: function(){}, // Triggers before a slide transition
		        afterChange: function(){}, // Triggers after a slide transition
		        slideshowEnd: function(){}, // Triggers after all slides have been shown
		        lastSlide: function(){}, // Triggers when last slide is shown
		        afterLoad: function(){} // Triggers when slider has loaded
    			});
	    });
    </script>
	</head>
	<body>
		<div id="headerWrapper">
			<div id="topBarCont">
				<div id="topBar   "></div>
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
		
	</body>
</html>