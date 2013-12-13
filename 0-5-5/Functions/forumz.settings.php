<?php
// Harris Christiansen
// Created 9-15-12

// Loads Settings And NavBar
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
	$sql="SELECT * FROM navBar ORDER BY navItemOrder";
	$result = dbQuery($sql) or die ("Query failed: displayNavBar");
	while($navItem = mysqli_fetch_array($result)) {
		$navLink = $siteSettings['siteURLShort'].$navItem['navItemLink']."/";
		if($navItem['navItemOrder']>=10) { if($rightItem!=true) { viewHTML(''); } $rightItem=true; }
		if($navItem['reqPermission']==""||userCan($navItem['reqPermission'])) {
			displayNavItem($navLink,$navItem['navItemName'],$rightItem);
		}
	}
}
?>