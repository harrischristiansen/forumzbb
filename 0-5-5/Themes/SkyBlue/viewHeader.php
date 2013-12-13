<?php
// Harris Christiansen
// Created 9-15-12

global $userData, $siteSettings;
defaultsInclude('registerLoginFields');
defaultsInclude('siteNotices');
defaultsInclude('navBar');
//// HTML Head ////
?>
<!DOCTYPE HTML>
<html><head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<link REL="SHORTCUT ICON" HREF="/Resources/images/f.png">
	<title><?php echo getPageTitle(); ?></title>
	<link rel="stylesheet" href="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/SkyBlue/SkyBlue.css" type="text/css">
	<!-- Jquery imports -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Scripts -->
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/SkyBlue/themeScripts.js"></script>
	<script src="/<?php echo $siteSettings['siteVersionAddress'];?>Themes/Defaults/siteScripts.js"></script>
	<!-- bValidator -->
	<link rel="stylesheet" href="/Resources/plugins/validator.css" />
	<script src="/Resources/plugins/jquery.bvalidator.js"></script>
</head><body>

<header id="navBar">
<?php //// Navigation Bar ////
// Left Side
viewHTML('<div class="headLeftSide">');
if($userData['loggedIn']) {
	viewHTML('<ul id="navMenu">');
	displayNavBar();
	viewHTML('</ul>');
} else {
	// Login Bar
	viewHTML('Login: ');
	viewSingleLineLoginField();
}

viewHTML('</div><div class="headRightSide">');

// Right Side
if($userData['loggedIn']) {
	// Search Bar
	viewHTML('<b>Search Here</b>');
} else {
	viewHTML('<ul id="navMenu">');
	displayNavBar();
	viewHTML('</ul>');
}

viewHTML('</div><div class="headCenter">');

// Middle
if($userData['loggedIn']) {
	// Welcome: Username Message
	viewHTML('<b>Welcome: '.returnUsername().'</b>');
} else {
	// Please Login Or Register Message
	viewHTML('<b>Please Login Or <a href="'.$siteSettings['siteURLShort'].'register/">Register</a></b>');
}
viewHTML('</div>');
?>
</header>

<?php //// Page Notices (Site Notices, Successes, Failures) ////
	displayAllNotices();
?>