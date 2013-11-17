<?php
// Harris Christiansen
// Created 9-14-12

// Forumz Sitewide References


function returnDateShort() {
	// Return Date in form MO-DA-YR
	return date('n-d-y');
}
function returnDateOfficial() {
	return date('Y-m-d');
}
function returnDateLong() {
	// Return Date in form Month Day, Year
	return date('F j, Y');
}
function returnTime() {
	// Returns Time in 24 Hour Time
	return date('H:i');
}
function returnUsername() {
	// Returns Username of current logged in user, "Anonymous" if not logged in.
	global $userData;
	if(isset($userData['username'])&&$userData['loggedIn']) {
		return ucwords($userData['username']);
	} else {
		return "Anonymous";
	}
}
function getUsername($userID) {
	$sql = "SELECT * FROM accounts WHERE actID='$userID'";
	$result = dbQuery($sql) or die ("Query failed: getUsername");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['username'];
}
function getUserEmail($user) {
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = dbQuery($sql) or die ("Query failed: getUserEmail");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['email'];
}
function getUserEncryptedPass($user) {
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = dbQuery($sql) or die ("Query failed: getUserEncryptedPass");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['password'];
}
function returnRemoteIP() {
	return $_SERVER['REMOTE_ADDR'];
}
function isLoggedIn() {
	// Returns true if user is logged in.
	global $userData;
	return $userData['loggedIn'];
}
function isSiteDisabled() {
	global $siteSettings;
	return $siteSettings['siteDisabled'];
}
function siteDisabledMessage() {
	global $siteSettings;
	if($siteSettings['disabledMessage']!="") {
		return $siteSettings['disabledMessage'];
	} else {
		return "The Site Is Currently Down For Maintenance.";
	}
}
function getSiteName() {
	global $siteSettings;
	return $siteSettings['siteName'];
}
function getSiteAddress() {
	return $_SERVER['SERVER_NAME'];
}
function getPageTitle() {
	global $specPageTitle;
	$pageTitle=getSiteName();
	if(isset($specPageTitle)) {
		$pageTitle=$pageTitle." - ".$specPageTitle;
	}
	return $pageTitle;
}
function getSiteMotd() {
	global $siteSettings;
	return $siteSettings['siteMotd'];
}
function getSiteSlogan() {
	global $siteSettings;
	return $siteSettings['siteSlogan'];
}
function display($fileName) {
	global $siteSettings, $userData;
	// Check userData for a set theme
	// Else set to default theme
	$themeToDisp = $siteSettings['defaultTheme'];
	// If custom theme load from theme
	// If file not found, load from default
	require_once($siteSettings['siteVersionAddress'].'Themes/'.$themeToDisp.'/'.$fileName.'.php');
}
function defaultsInclude($fileName) {
	global $siteSettings;
	require_once($siteSettings['siteVersionAddress'].'Themes/Defaults/'.$fileName.'.php');
}
function viewHTML($HTMLtxt) {
	echo "	".$HTMLtxt."\n";
}
?>