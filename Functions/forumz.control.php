<?php
// Harris Christiansen
// Created 10-10-12
// Updated 5-16-13

function displayCPNav() {
	global $siteSettings, $userData;
	displayCPNavItem("Change Password",$siteSettings['siteURLShort']."controlPanel/changePassword/");
	displayCPNavItem("Edit Profile",$siteSettings['siteURLShort']."controlPanel/editProfile/");
	displayCPNavItem("Change Preferences",$siteSettings['siteURLShort']."controlPanel/changePreferences/");
	if($userData['permissions']['editSiteSettings']=="true") {
		displayCPNavItem("Edit Site Settings",$siteSettings['siteURLShort']."controlPanel/editSiteSettings/");
		displayCPNavItem("Edit Ranks",$siteSettings['siteURLShort']."controlPanel/editRanks/");
	}
}

function displayCPContent() {
	global $pageID, $siteSettings, $pagePost, $userData;
	$siteURL=$siteSettings['siteURLShort'];
	if($pageID=="changePassword") { changePasswordForm($siteURL); $pageNotFound=false; }
	elseif($pageID=="editProfile") { editProfileForm($userData['email'],$siteURL); $pageNotFound=false; }
	elseif($pageID=="changePreferences") { changePreferencesForm($siteURL); $pageNotFound=false; }
	elseif($userData['permissions']['editSiteSettings']=="true") {
		if($pageID=="editSiteSettings") {
			global $siteSettings;
			$pageNotFound=false;
			if($siteSettings['reqLogin']) { $reqLoginChecked="checked"; }
			else { $reqLoginChecked=""; }
			editSiteSettingsForm($siteURL,$siteSettings['siteName'],$siteSettings['siteMotd'],$siteSettings['siteSlogan'],$siteSettings['disabledMessage'],$reqLoginChecked,$siteSettings['blogEntriesPerPage']);
		}
		if($pageID=="addRank") { addRankForm($siteURL); $pageNotFound=false; }
		if($pageID=="editRanks") { editRanksControlPanel(); $pageNotFound=false; }
	}
	else { viewHTML('Please Select An Item From The Menu On The Left.'); }
}

function updateAccountPassword() {
	global $userData, $pagePost;
	// Get Username From Session, Passwords From Form
	$username=$userData['username'];
	$accountID=$userData['actID'];
	$oldPass=$pagePost['oldPass'];
	$newPass=$pagePost['newPass'];
	$newPassCon=$pagePost['newPassCon'];
	$newPassEncrypted=md5($newPass);
	// Check To Make Sure Password Matches Username
	if(checkLogin($username, $oldPass)==-1) {
		addFailureNotice("Invalid Password: Old Password Did Not Match");
	}
	// Check To Make Sure New Passwords match
	elseif($newPass!=$newPassCon) {
		addFailureNotice("Error: New Passwords Did Not Match");
	}
	// Change Password
	else {
		$sql = "UPDATE accounts SET password='$newPassEncrypted' WHERE actID='$accountID'";
		$result = dbQuery($sql) or die ("Query failed: updateAccountPassword");
		addSuccessNotice("Success: Password Changed");
	}
}

function updateAccountProfile() {
	global $userData, $pagePost, $con;
	$accountID=$userData['actID'];
	$newEmail=mysqli_real_escape_string($con, $pagePost['newEmail']);
	$sql = "UPDATE accounts SET email='$newEmail' WHERE actID='$accountID'";
	$result = dbQuery($sql) or die ("Query failed: updateAccountProfile");
	addSuccessNotice("Success: Profile Updated");
}

function updateSiteSettings() {
	global $pagePost, $con;
	$siteName=mysqli_real_escape_string($con, $pagePost['siteName']);
	$siteMotd=mysqli_real_escape_string($con, $pagePost['siteMotd']);
	$siteSlogan=mysqli_real_escape_string($con, $pagePost['siteSlogan']);
	$siteDisabled=mysqli_real_escape_string($con, $pagePost['siteDisabled']);
	$reqLogin=mysqli_real_escape_string($con, $pagePost['reqLogin']);
	$numBlogEntriesPerPage=mysqli_real_escape_string($con, $pagePost['numBlogEntriesPerPage']);
	
	$sql = "UPDATE siteSettings SET siteName='$siteName',siteMotd='$siteMotd',siteSlogan='$siteSlogan',siteDisabled='$siteDisabled',reqLogin='$reqLogin',blogEntriesPerPage='$numBlogEntriesPerPage' WHERE settingsProfile='1'";
	$result = dbQuery($sql) or die ("Query failed: updateSiteSettings");
	addSuccessNotice("Success: Site Settings Updated");
}

function addSiteRank() {
	global $pagePost, $con;
	$rankName=mysqli_real_escape_string($con, $pagePost['rankName']);
	$editSiteSettings=mysqli_real_escape_string($con, $pagePost['editSiteSettings']);
	$rankID=getNumSiteRanks();
	
	$sql = "INSERT INTO ranks (rankID, rankName, editSiteSettings) VALUES ('$rankID','$rankName','$editSiteSettings')";
	$result = dbQuery($sql) or die ("Query failed: addSiteRank");
	addSuccessNotice("Success: Rank Added");
}

function getNumSiteRanks() {
	$sql = "SELECT * FROM ranks";
	$result = dbQuery($sql) or die ("Query failed: getNumSiteRanks");
	return mysqli_num_rows($result);
}

function editRanksControlPanel() {
	global $siteSettings, $pageID2;
	$siteURL=$siteSettings['siteURLShort'];
	if($pageID2!="none") {
		$sql = "SELECT * FROM ranks WHERE rankID='$pageID2'";
		$result = dbQuery($sql) or die ("Query failed: editRanksControlPanel");
		$rankArray = mysqli_fetch_array($result);
		if($rankArray['editSiteSettings']=="true") { $editSiteSettingsChecked="checked"; } else { $editSiteSettingsChecked=""; }
		if($rankArray['editMemberRank']=="true") { $editMemberRankChecked="checked"; } else { $editMemberRankChecked=""; }
		editRanksForm($siteURL,$rankArray['rankID'],$rankArray['rankName'],$editSiteSettingsChecked,$editMemberRankChecked);
	} else {
		editRanksForm($siteURL,"","","","");
	}
}

function displayRankNavItems() {
	global $siteSettings;
	$sql = "SELECT * FROM ranks";
	$result = dbQuery($sql) or die ("Query failed: displayRankNavItems");
	while($rank = mysqli_fetch_array($result)) {
		$rankLink=$siteSettings['siteURLShort']."controlPanel/editRanks/".$rank['rankID']."/";
		if($rank['rankID']=="0") {
			displayRankNavItem("Unregistered User",$rankLink);
		} else {
			displayRankNavItem($rank['rankName'],$rankLink);
		}
	}
	$rankLink=$siteSettings['siteURLShort']."controlPanel/addRank/";
	displayRankNavItem("Add Rank",$rankLink);
}

function updateRank() {
	global $pagePost, $pageID2, $con;
	$rankName=mysqli_real_escape_string($con, $pagePost['rankName']);
	$editSiteSettings=mysqli_real_escape_string($con, $pagePost['editSiteSettings']);
	$editMemberRank=mysqli_real_escape_string($con, $pagePost['editMemberRank']);
	
	$sql = "UPDATE ranks SET rankName='$rankName',editSiteSettings='$editSiteSettings',editMemberRank='$editMemberRank' WHERE rankID='$pageID2'";
	$result = dbQuery($sql) or die ("Query failed: updateRank");
	addSuccessNotice("Success: Rank Updated");
}
?>