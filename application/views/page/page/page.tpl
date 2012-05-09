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
		<? echo $main->getHeader(); ?>
	</head>
	<body>
		<div id="headerWrapper">
			<div id="topBarCont">
				<div id="topBar   "></div>
			</div>
			<div id="topBannerCont">
				<div id="topBanner"></div>
			</div>
			<div id="menuWrapperCont">
				<div id="menuWrapper"></div>
			</div>
			<div id="titleBarCont">
				<div id="titleBar"></div>
			</div>
		</div>

		<div id="bodyWrapper">
			<div id="bodyContainer">
				<div id="content">
				</div>
				<div id="sider">
				</div>
			</div>
		</div>

		<div id="footerWrapper">
			<div id="footerContent">
			</div>
			<div id="footerSider">
			</div>
		</div>
		
	</body>
</html>