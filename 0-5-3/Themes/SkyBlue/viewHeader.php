<?php
// Harris Christiansen
// Created 9-15-12
// Updated 6-1-13

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
</head><body>

<header id="navBar">
<?php //// Navigation Bar ////
// Left Side
viewHTML('<div class="headFootLeftSide">');
if($userData['loggedIn']) {
	displayNavBar();
} else {
	// Login Bar
	viewHTML('Login: ');
	viewSingleLineLoginField();
}

viewHTML('</div><div class="headFootRightSide">');

// Right Side
if($userData['loggedIn']) {
	// Search Bar
	viewHTML('<b>Search Here</b>');
} else {
	displayNavBar();
}

viewHTML('</div><div class="headFootCenter">');

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