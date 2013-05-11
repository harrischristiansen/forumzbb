<?php
// Harris Christiansen
// Created 9-14-12
// Updated 10-2-12

// Forumz Sitewide References


function returnDateShort() {
	// Return Date in form MO-DA-YR
	return date('m-d-y');
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
function getSiteMotd() {
	global $siteSettings;
	return $siteSettings['siteMotd'];
}
function getSiteSlogan() {
	global $siteSettings;
	return $siteSettings['siteSlogan'];
}
function getSiteNumMembers() {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM accounts";
	$result = mysqli_query($con,$sql) or die ("Query failed: getSiteNumMembers");
	$sqlQueries++;
	return mysqli_num_rows($result);
}
function display($fileName) {
	require_once('Themes/SkyBlue/'.$fileName.'.php');
}
function defaultsInclude($fileName) {
	require_once('Themes/Defaults/'.$fileName.'.php');
}
function viewHTML($HTMLtxt) {
	echo "	".$HTMLtxt."\n";
}
?>