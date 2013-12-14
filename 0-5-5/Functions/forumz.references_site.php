<?php
// Harris Christiansen
// Created 2013-12-14

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
	return date('H:i:s');
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
?>