<?php
// Harris Christiansen
// Created 9-15-12
// Updated 5-29-13

// Rank Permissions + Control Systems


function setUserPrivileges() { // Sets a users permissions based on their rank - Stored in UserData
	// Get Rank ID
	global $userData;
	$userRank=$userData['rankID'];
	
	// Set User Data Privledges
	$sql = "SELECT * FROM ranks WHERE rankID='$userRank'";
	$result = dbQuery($sql) or die ("Query failed: setUserPrivileges");
	$userData['permissions']=mysqli_fetch_array($result);
}

function setUserRank() {
	global $userData, $pageID2, $pagePost, $con;
	$userID=$pageID2;
	$tarRank=mysqli_real_escape_string($con, $pagePost['newRank']);
	if(!hasPermissionToEditRank($tarRank)||$tarRank==0) { // Attempting to Promote User to your rank or above, or into pre-login rank
		addFailureNotice("Permission Denied");
	}
	elseif(!hasPermissionToEditRank(getUserRank($userID))) { // Attempting to demote someone of your rank or above
		addFailureNotice("Permission Denied");
	} else {
	
	$sql = "UPDATE accounts SET rankID='$tarRank' WHERE actID='$userID'";
	$result = dbQuery($sql) or die ("Query failed: setUserRank");
	addSuccessNotice("Changed ".getMemberName($pageID2)."'s Rank");
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
	if($userData['loggedIn']&&$userData['permissions']['editMemberRank']=="true"&&getOrderOfRank($rankID)<$userData['permissions']['rankOrder']) {
		return true;
	}
	return false;
}
function hasPermissionToEditRankOrder($rankOrder) {
	global $userData;
	if($userData['loggedIn']&&$userData['permissions']['editMemberRank']=="true"&&$rankOrder<$userData['permissions']['rankOrder']&&$rankOrder!=0) { // Used For Determining Swaping Ranks
		return true;
	}
	return false;
}
?>