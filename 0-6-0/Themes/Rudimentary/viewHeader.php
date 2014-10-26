<?php
// Harris Christiansen
// Created 9-15-12

global $userData, $siteSettings;
themeInclude('siteNotices');
themeInclude('loginWindow');
defaultsInclude('navBar');
//// HTML Head ////
?>
<!DOCTYPE HTML>
<html><head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<link REL="SHORTCUT ICON" HREF="/Resources/siteImages/f.png">
	<meta name="viewport" content="width=device-width">
	<? displayMetadata(); ?>
	<title><?php echo getPageTitle(); ?></title>
	<link rel="stylesheet" href="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Rudimentary/Rudimentary.css" type="text/css">
	<!-- Jquery imports -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Site Scripts -->
	<script>var phpSessionName="<? echo session_name(); ?>";</script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Defaults/siteScripts.js"></script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Rudimentary/themeScripts.js"></script>
	<!-- bValidator -->
	<link rel="stylesheet" href="/Resources/plugins/bvalidator/validator.css" />
	<script src="/Resources/plugins/bvalidator/jquery.bvalidator.js"></script>
	<!-- SCEditor -->
	<link rel="stylesheet" href="/Resources/plugins/sceditor/minified/themes/monocons.min.css" type="text/css" media="all" />
	<script type="text/javascript" src="/Resources/plugins/sceditor/minified/jquery.sceditor.bbcode.min.js"></script>
</head><body><div id="siteContainer">

<header>
	<a href="/home/" id="siteLogo" class="noSelect"><img src="/Resources/siteImages/logo.png" alt="<? echo getSiteName(); ?>"></a>
	<? if($userData['loggedIn']) {
		viewHTML('<div id="guestInfo">Welcome, <b>'.returnUsername().'</b>.</div>');
	} else {
		viewHTML('<div id="guestInfo">Welcome, <b>Guest</b>.<br>Please <a href="#" class="loginWindButton">Login</a> or <a href="'.$siteSettings['siteURLShort'].'register/">Register</a>.</div>');
	} ?>
</header>

<div id="navBar">
	<div id="navHandle">Navigation</div>
	<ul id="navMenu">
		<? if(!isLoggedIn()) { ?>
			<li id="menuBarLoginItem" class="loginWindButton"></li>
		<? } ?>
		<? displayNavBar(); ?>
		<? if(!isLoggedIn()) { ?>
			<li class="navItem loginWindButton navItem-hidden"><a href="#">Login</a></li>
		<? } ?>
		<? if(userCan('useChat')) { ?>
			<li class="navItem navItem-hidden" id="menuBarChatButton"><a href="#">Chat</a></li>
		<? } ?>
	</ul>
	<? if(!isLoggedIn()) { viewLoginWindow(); } ?>
</div>

<div class="centerPanel" id="mainContainer">
<?php //// Page Notices (Site Notices, Successes, Failures) ////
	displayAllNotices();
?>