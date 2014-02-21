<?php
// Harris Christiansen
// Created 2013-12-14

function display($fileName) {
	global $siteSettings, $userData;
	if($userData['themePref']!="") {
		$themeToDisp = $userData['themePref'];
	} else {
		$themeToDisp = $siteSettings['defaultTheme'];
	}
	if((@include_once $siteSettings['siteVersionAddress'].'Themes/'.$themeToDisp.'/'.$fileName.'.php') === false) {
		require_once($siteSettings['siteVersionAddress'].'Themes/SkyBlue/'.$fileName.'.php');
	}
}function displayWithTheme($fileName,$themeName) {
	global $siteSettings;
	require_once($siteSettings['siteVersionAddress'].'Themes/'.$themeName.'/'.$fileName.'.php');
}
function defaultsInclude($fileName) {
	global $siteSettings;
	require_once($siteSettings['siteVersionAddress'].'Themes/Defaults/'.$fileName.'.php');
}
function themeInclude($fileName) {
	global $siteSettings, $userData;
	if($userData['themePref']!="") {
		$themeToDisp = $userData['themePref'];
	} else {
		$themeToDisp = $siteSettings['defaultTheme'];
	}
	if((@include_once $siteSettings['siteVersionAddress'].'Themes/'.$themeToDisp.'/'.$fileName.'.php') === false) {
		require_once($siteSettings['siteVersionAddress'].'Themes/Defaults/'.$fileName.'.php');
	}
}
function viewHTML($HTMLtxt) {
	echo "	".$HTMLtxt."\n";
}
?>