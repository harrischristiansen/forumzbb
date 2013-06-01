<?php
// Harris Christiansen
// Created 6-1-13
// Updated 6-1-13

// Loads Site Settings from Database


function loadSiteSettings() {
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
	// Site Version
	if($setting['siteVersion']!="") {
		$siteSettings['siteVersion']=$setting['siteVersion'];
		$siteSettings['siteVersionAddress']=$setting['siteVersion']."/";
	}
}

function dbQuery($sql) {
	global $con, $sqlQueries;
	// Get Table Title
	$tableTitle=session_name();
	$tableTitle_from="FROM ".$tableTitle."_";
	$tableTitle_upd="UPDATE ".$tableTitle."_";
	$tableTitle_inst="INSERT INTO ".$tableTitle."_";
	// Append Table Title
	$sql = str_replace("FROM ",$tableTitle_from,$sql);
	$sql = str_replace("UPDATE ",$tableTitle_upd,$sql);
	$sql = str_replace("INSERT INTO ",$tableTitle_inst,$sql);
	// Execute Query and Return Result
	$sqlQueries++;
	return mysqli_query($con, $sql);
}
?>