<?php
// Harris Christiansen
// Created 9-15-12
// Updated 10-15-12

global $userData, $siteSettings;
defaultsInclude(registerLoginFields);
defaultsInclude(siteNotices);
//// HTML Head ////
?>
<!DOCTYPE HTML>
<html><head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<link REL="SHORTCUT ICON" HREF="/Resources/images/f.png">
	<title><?php echo getSiteName(); ?></title>
	<link rel="stylesheet" href="/Themes/SkyBlue/SkyBlue.css" type="text/css">
</head><body>

<header id="navBar">
<?php //// Navigation Bar ////
// Left Side
viewHTML('<div class="headFootLeftSide">');
if($userData['loggedIn']) {
	// Navigation (Home, Members List, Control Panel, Logout)
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'home/">Home</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'membersList/">Members List</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'controlPanel/">Control Panel</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'logout/">Logout</a>');
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
	// Navigation (Home, Members List, Login, Register)
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'home/">Home</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'membersList/">Members List</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'login/">Login</a>');
	viewHTML('<a href="'.$siteSettings['siteURLShort'].'register/">Register</a>');
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