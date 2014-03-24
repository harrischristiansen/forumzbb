<?php
// Harris Christiansen
// Created 9-15-12

// Rank Permissions + Control Systems


function setUserPrivileges() { // Sets a users permissions based on their rank - Stored in UserData
	// Get Rank ID
	global $userData;
	$userRank=$userData['rankID'];
	
	// Set User Data Privledges
	$sql = "SELECT * FROM ranks WHERE rankID='$userRank'";
	$result = dbQuery($sql) or die ("Query failed: setUserPrivileges");
	$rankArray=mysqli_fetch_array($result);
	$userData['permissions']=unserialize($rankArray['permissions']);
	$userData['permissions']['rankOrder']=$rankArray['rankOrder'];
	$userData['permissions']['loggedIn']=isLoggedIn();
	$userData['permissions']['loggedOut']=!isLoggedIn();
}

function setUserRank() {
	global $userData, $pageID2, $pagePost;
	$userID=$pageID2;
	$tarRank=cleanInput($pagePost['newRank']);
	if(!hasPermissionToEditRank(getUserRank($userID))) { // Attempting to edit someone of equal or greater rank
		addFailureNotice("Permission Denied");
		return false;
	}
	if(is_numeric($tarRank)) {
		if(!hasPermissionToEditRank($tarRank)||$tarRank==0) { // Attempting to Promote User to your rank or above, or into pre-login rank
			addFailureNotice("Permission Denied");
		} else {
			$sql = "UPDATE accounts SET rankID='$tarRank' WHERE actID='$userID'";
			$result = dbQuery($sql) or die ("Query failed: setUserRank");
			addSuccessNotice("Changed ".getMemberName($pageID2)."'s Rank");
		}
	} else {
		if($tarRank=="rename") { flagForRename($userID); addSuccessNotice("Flagged ".getMemberName($pageID2)." for rename."); }
		elseif($tarRank=="noRename") { unflagForRename($userID); addSuccessNotice("Unflagged ".getMemberName($pageID2)." for rename."); }
		elseif($tarRank=="ban") { setAccountAsLocked($userID); addSuccessNotice("Banned ".getMemberName($pageID2)."."); }
		elseif($tarRank=="unban") { setAccountAsActive($userID); addSuccessNotice("Removed Ban From ".getMemberName($pageID2)."."); }
	}
}

function getChangeRankList($actID) {
	global $siteSettings;
	$formURL=$siteSettings['siteURLShort']."membersList/changeUserRank/".$actID."/";
	displayChangeRankList($formURL,$actID);
}

function getChangeRankListOptions($actID) {
	// Get Users Rank ID
	$userRank=getUserRank($actID);
	$actFlags = getAccountFlags($actID);
	
	// Flag User for Rename Option
	if(userCan("flagRenames")&&$actFlags['userRename']=="0") { displayChangeRankListOption(" - Flag For Rename - ", "rename", ""); }
	elseif(userCan("flagRenames")&&$actFlags['userRename']=="1") { displayChangeRankListOption(" - Unflag For Rename - ", "noRename", ""); }
	if(userCan("banUsers")&&$actFlags['status']=="1") { displayChangeRankListOption(" - Ban User - ", "ban", ""); }
	elseif(userCan("banUsers")&&$actFlags['status']=="0") { displayChangeRankListOption(" - Remove Ban From User - ", "unban", ""); }
	
	// Display Rank List With Current Rank Selected
	$sql = "SELECT * FROM ranks ORDER BY rankOrder";
	$result = dbQuery($sql) or die ("Query failed: getChangeRankListOptions-Ranks");
	while($rank = mysqli_fetch_array($result)) {
		if($rank['rankID']==$userRank) { $optSelected="selected"; } else { $optSelected=""; }
		if(hasPermissionToEditRank($rank['rankID'])&&$rank['rankID']!=0) { // Limits Options Displayed To Only Those Allowed
			displayChangeRankListOption($rank['rankName'], $rank['rankID'], $optSelected);
		}
	}
}

function getOrderOfRank($rankID) {
	$sql = "SELECT * FROM ranks WHERE rankID='$rankID'";
	$result = dbQuery($sql) or die ("Query failed: getOrderOfRank");
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['rankOrder'];
}


// Misc
function getHighestRankID() {
	$sql = "SELECT * FROM ranks ORDER BY rankOrder DESC";
	$result = dbQuery($sql) or die ("Query failed: getHighestRankID");
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['rankID'];
	
}
function getHighestRankOrder() {
	$sql = "SELECT * FROM ranks ORDER BY rankOrder DESC";
	$result = dbQuery($sql) or die ("Query failed: getHighestRankID");
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['rankOrder'];
	
}
function hasPermissionToEditRank($rankID) {
	global $userData;
	if(isLoggedIn()&&userCan('editMemberRank')&&getOrderOfRank($rankID)<$userData['permissions']['rankOrder']) { // Can edit up to own rank
		return true;
	}
	if($userData['rankID']==getHighestRankID()) { // Is Admin of site
		return true;
	}
	return false;
}
function hasPermissionToEditRankOrder($rankOrder) { // Used For Determining Swaping Ranks
	global $userData;
	if($userData['loggedIn']&&userCan('editMemberRank')&&$rankOrder<$userData['permissions']['rankOrder']&&$rankOrder!=0) {
		return true;
	}
	return false;
}
?>