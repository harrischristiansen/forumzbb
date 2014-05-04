<?php
// Harris Christiansen
// Created 9-15-12

// Loads Settings And NavBar
function getDefaultAccountFlags() {
	global $siteSettings;
	$actFlags['status'] = "1";
	if($siteSettings['verifyRegisterEmail']) { $actFlags['emailConfirmed']="0"; } else { $actFlags['emailConfirmed']="1"; }
	if($siteSettings['verifyRegisterAdmin']) { $actFlags['adminConfirmed']="0"; } else { $actFlags['adminConfirmed']="1"; }
	$actFlags['userRename'] = "0";
	return base64_encode(serialize($actFlags));
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