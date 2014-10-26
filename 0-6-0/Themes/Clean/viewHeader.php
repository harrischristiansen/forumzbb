<?php
// Harris Christiansen (HarrisChristiansen.com)
// Created 2014-10-26

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
	<link rel="stylesheet" href="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Clean/Clean.css" type="text/css">
	<!-- Jquery imports -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Site Scripts -->
	<script>var phpSessionName="<? echo session_name(); ?>";</script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Defaults/siteScripts.js"></script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Clean/themeScripts.js"></script>
	<!-- bValidator -->
	<link rel="stylesheet" href="/Resources/plugins/bvalidator/validator.css" />
	<script src="/Resources/plugins/bvalidator/jquery.bvalidator.js"></script>
	<!-- SCEditor -->
	<link rel="stylesheet" href="/Resources/plugins/sceditor/minified/themes/monocons.min.css" type="text/css" media="all" />
	<script type="text/javascript" src="/Resources/plugins/sceditor/minified/jquery.sceditor.bbcode.min.js"></script>
</head><body><div id="siteContainer">

<header><div class="siteCont">
	<a href="/home/" id="siteLogo" class="noSelect"><img src="/Resources/siteImages/logo.png" alt="<? echo getSiteName(); ?>"></a>
	<ul id="navBar">
		<? displayNavBar(); ?>
		<? if(!isLoggedIn()) { ?>
			<li class="navItem loginWindButton navItem-hidden"><a href="#">Login</a></li>
		<? } ?>
		<? if(!isLoggedIn()) { viewLoginWindow(); } ?>
	</ul>
</div></header>

<div id="pageHead"><div class="siteCont">
	<div id="breadcrumbs">Home / Page</div>
	<h2>Some Page</h2>
</div></div>
	
<?php //// Page Notices (Site Notices, Successes, Failures) ////
	displayAllNotices();
?>