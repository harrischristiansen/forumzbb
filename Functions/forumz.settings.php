<?php
// Harris Christiansen
// Created 9-15-12
// Updated 5-29-13

// Loads Forumz Settings from Database
// Callable Functions: getDefaultAccountStatus()


function loadMysqlSettings() {
	// Get Settings Array From Database
	$sql = "SELECT * FROM siteSettings WHERE settingsProfile='1'";
	$result = dbQuery($sql) or die ("Query failed: getSiteSettings");
	$setting=mysqli_fetch_array($result);
	
	// Set Site Settings
	global $siteSettings;
	if($setting['siteDisabled']!="") {
		$siteSettings['siteDisabled']=true;
		$siteSettings['disabledMessage']=$setting['siteDisabled'];
	} else { $siteSettings['siteDisabled']=false; }
	$siteSettings['siteName'] = $setting['siteName'];
	$siteSettings['siteMotd'] = $setting['siteMotd'];
	$siteSettings['siteSlogan'] = $setting['siteSlogan'];
	$siteSettings['defaultTheme'] = $setting['defaultTheme'];
	$siteSettings['blogEntriesPerPage'] = $setting['blogEntriesPerPage'];
	if($setting['reqLogin']=="true") {
		$siteSettings['reqLogin'] = true;
	} else { $siteSettings['reqLogin'] = false; }
	if($setting['verifyRegisterEmail']=="true") {
		$siteSettings['verifyRegisterEmail'] = true;
	} else { $siteSettings['verifyRegisterEmail'] = false; }
	if($setting['verifyRegisterAdmin']=="true") {
		$siteSettings['verifyRegisterAdmin'] = true;
	} else { $siteSettings['verifyRegisterAdmin'] = false; }
	if($setting['htmlAllowed']=="true") {
		$siteSettings['htmlAllowed'] = true;
	} else { $siteSettings['htmlAllowed'] = false; }
}
function getDefaultAccountStatus() {
	global $siteSettings;
	if($siteSettings['verifyRegisterAdmin']&&$siteSettings['verifyRegisterEmail']) {
		return 12;
	}
	elseif($siteSettings['verifyRegisterEmail']) {
		return 1;
	}
	elseif($siteSettings['verifyRegisterAdmin']) {
		return 2;
	}
	else {
		return 0;
	}
}
function setupSiteURLs() {
	global $siteSettings;
	$siteSettings['siteURLShort']="/";
	if(isset($_GET['siteAddress'])) {
		$siteSettings['siteURLShort']="/".$_GET['siteAddress']."/";
	}
	$siteSettings['siteURLLong']="http://".$_SERVER['SERVER_NAME'].$siteSettings['siteURLShort'];
}
function displayNavBar() {
	global $siteSettings;
	if(isLoggedIn()) {
		$sql="SELECT * FROM navBar WHERE navItemDisplay='loggedIn' ORDER BY navItemOrder";
	} else {
		$sql="SELECT * FROM navBar WHERE navItemDisplay='loggedOut' ORDER BY navItemOrder";
	}
	$result = dbQuery($sql) or die ("Query failed: displayNavBar");
	while($navItem = mysqli_fetch_array($result)) {
		$navLink = $siteSettings['siteURLShort'].$navItem['navItemLink']."/";
		displayNavItem($navLink,$navItem['navItemName']);
	}
}
?>