<?php
// Harris Christiansen
// Created 10-10-12
// Updated 5-27-13

function displayCPNav() {
	global $siteSettings, $userData;
	displayCPNavItem("Change Password",$siteSettings['siteURLShort']."controlPanel/changePassword/");
	displayCPNavItem("Edit Profile",$siteSettings['siteURLShort']."controlPanel/editProfile/");
	displayCPNavItem("Change Preferences",$siteSettings['siteURLShort']."controlPanel/changePreferences/");
	if($userData['permissions']['editSiteSettings']=="true") {
		displayCPNavItem("Edit Site Settings",$siteSettings['siteURLShort']."controlPanel/editSiteSettings/");
	}
	if($userData['permissions']['editRanks']=="true") {
		displayCPNavItem("Edit Ranks",$siteSettings['siteURLShort']."controlPanel/editRanks/");
	}
}

function displayCPContent() {
	global $pageID, $siteSettings, $pagePost, $userData;
	$siteURL=$siteSettings['siteURLShort'];
	$pageNotFound=true;
	
	// Common Pages
	if($pageID=="changePassword") { changePasswordForm($siteURL); $pageNotFound=false; }
	elseif($pageID=="editProfile") { editProfileForm($userData['email'],$siteURL); $pageNotFound=false; }
	elseif($pageID=="changePreferences") { changePreferencesForm($siteURL); $pageNotFound=false; }
	
	// Permission Restricted Pages
	if($userData['permissions']['editSiteSettings']=="true") {
		if($pageID=="editSiteSettings") {
			global $siteSettings;
			$pageNotFound=false;
			if($siteSettings['reqLogin']) { $reqLoginChecked="checked"; }
			else { $reqLoginChecked=""; }
			editSiteSettingsForm($siteURL,$siteSettings['siteName'],$siteSettings['siteMotd'],$siteSettings['siteSlogan'],$siteSettings['disabledMessage'],$reqLoginChecked,$siteSettings['blogEntriesPerPage']);
		}
	}
	if($userData['permissions']['editRanks']=="true") {
		if($pageID=="addRank") { addRankForm($siteURL); $pageNotFound=false; }
		if($pageID=="editRanks") { editRanksControlPanel(); $pageNotFound=false; }
	}
	
	// Page Not Found
	if($pageNotFound) { viewHTML('Please Select An Item From The Menu On The Left.'); }
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

function getNumSiteRanks() {
	$sql = "SELECT * FROM ranks";
	$result = dbQuery($sql) or die ("Query failed: getNumSiteRanks");
	return mysqli_num_rows($result);
}

function editRanksControlPanel() {
	global $siteSettings, $pageID2;
	$siteURL=$siteSettings['siteURLShort'];
	$sql = "SELECT * FROM ranks WHERE rankID='$pageID2'";
	$result = dbQuery($sql) or die ("Query failed: editRanksControlPanel");
	$rankArray = mysqli_fetch_array($result);
	// Get Checked Items
	if($rankArray['editSiteSettings']=="true") { $settingChecked['editSiteSettings']="checked"; } else { $settingChecked['editSiteSettings']=""; }
	if($rankArray['editMemberRank']=="true") { $settingChecked['editMemberRank']="checked"; } else { $settingChecked['editMemberRank']=""; }
	if($rankArray['editRanks']=="true") { $settingChecked['editRanks']="checked"; } else { $settingChecked['editRanks']=""; }
	if($rankArray['postBlogEntries']=="true") { $settingChecked['postBlogEntries']="checked"; } else { $settingChecked['postBlogEntries']=""; }
	if($rankArray['postBlogComments']=="true") { $settingChecked['postBlogComments']="checked"; } else { $settingChecked['postBlogComments']=""; }
	// Display Form
	editRanksForm($siteURL,$rankArray['rankID'],$rankArray['rankName'],$settingChecked);
}

function displayRankNavItems() {
	global $siteSettings;
	$sql = "SELECT * FROM ranks ORDER BY rankOrder";
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

// Both need to confirm that only highest ranking member can edit ranks permissions
function addSiteRank() {
	global $pagePost, $con, $userData;
	$rankName=mysqli_real_escape_string($con, $pagePost['rankName']);
	$editSiteSettings=mysqli_real_escape_string($con, $pagePost['editSiteSettings']);
	$editMemberRank=mysqli_real_escape_string($con, $pagePost['editMemberRank']);
	$editRanks=mysqli_real_escape_string($con, $pagePost['editRanks']);
	$postBlogEntries=mysqli_real_escape_string($con, $pagePost['postBlogEntries']);
	$postBlogComments=mysqli_real_escape_string($con, $pagePost['postBlogComments']);
	$rankID=getNumSiteRanks();
	if(getHighestRankID()!=$userData['rankID']) {
		addFailureNotice("Permission Denied");
	} else {
		$sql = "INSERT INTO ranks (rankID, rankOrder, rankName, editSiteSettings, editMemberRank, editRanks, postBlogEntries, postBlogComments) VALUES ('$rankID','$rankID','$rankName','$editSiteSettings','$editMemberRank','$editRanks','$postBlogEntries','$postBlogComments')";
		$result = dbQuery($sql) or die ("Query failed: addSiteRank");
		addSuccessNotice("Success: Rank Added");
	}
}

function updateRank() {
	global $pagePost, $pageID2, $con, $userData;
	$tarRank=$pageID2;
	$rankName=mysqli_real_escape_string($con, $pagePost['rankName']);
	$editSiteSettings=mysqli_real_escape_string($con, $pagePost['editSiteSettings']);
	$editMemberRank=mysqli_real_escape_string($con, $pagePost['editMemberRank']);
	$editRanks=mysqli_real_escape_string($con, $pagePost['editRanks']);
	$postBlogEntries=mysqli_real_escape_string($con, $pagePost['postBlogEntries']);
	$postBlogComments=mysqli_real_escape_string($con, $pagePost['postBlogComments']);
	
	if(getOrderOfRank($tarRank)>=getOrderOfRank($userData['rankID'])) { // Attempting to Edit Rank Greater Than Own
		addFailureNotice("Permission Denied");
	} else if(getHighestRankID()!=$userData['rankID']) {
		$sql = "UPDATE ranks SET rankName='$rankName' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank");
		addSuccessNotice("Success: Rank Updated");
	} else {
		$sql = "UPDATE ranks SET rankName='$rankName',editSiteSettings='$editSiteSettings',editMemberRank='$editMemberRank',editRanks='$editRanks',postBlogEntries='$postBlogEntries',postBlogComments='$postBlogComments' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank");
		addSuccessNotice("Success: Rank Updated");
	}
}
?>