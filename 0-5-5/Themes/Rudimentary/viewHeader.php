<?php
// Harris Christiansen
// Created 9-15-12

global $userData, $siteSettings;
themeInclude('siteNotices');
defaultsInclude('navBar');
//// HTML Head ////
?>
<!DOCTYPE HTML>
<html><head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<link REL="SHORTCUT ICON" HREF="/Resources/images/f.png">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title><?php echo getPageTitle(); ?></title>
	<link rel="stylesheet" href="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Rudimentary/Rudimentary.css" type="text/css">
	<!-- Jquery imports -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Site Scripts -->
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Defaults/siteScripts.js"></script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Rudimentary/themeScripts.js"></script>
	<!-- bValidator -->
	<link rel="stylesheet" href="/Resources/plugins/validator.css" />
	<script src="/Resources/plugins/jquery.bvalidator.js"></script>
</head><body>

<header>
	<a href="/home/" id="siteLogo" class="noSelect"><img src="/Resources/siteImages/logo.png" alt="<? echo getSiteName(); ?>"></a>
	<? if($userData['loggedIn']) {
		viewHTML('<div id="guestInfo">Welcome, <b>'.returnUsername().'</b>.</div>');
	} else {
		viewHTML('<div id="guestInfo">Welcome, <b>Guest</b>.<br>Please Login or <a href="'.$siteSettings['siteURLShort'].'register/">Register</a>.</div>');
	} ?>
</header>

<div id="navBar">
	<ul id="navMenu">
		<? if(isLoggedIn()) { ?>
		<? } ?>
		<? displayNavBar(); ?>
	</ul>
</div>

<div class="centerPanel siteContainer">
<?php //// Page Notices (Site Notices, Successes, Failures) ////
	displayAllNotices();
?>