<?php
// Harris Christiansen
// Created 9-15-12
// Updated 5-12-13

// Rank Permissions + Control Systems


function setUserPrivileges() {
	// Get Rank ID
	global $userData;
	$userRank=$userData['rankID'];
	
	// Set User Data Privledges
	global $con, $sqlQueries;
	$sql = "SELECT * FROM ranks WHERE rankID='$userRank'";
	$result = mysqli_query($con, $sql) or die ("Query failed: setUserPrivileges");
	$userData['permissions']=mysqli_fetch_array($result);
	$sqlQueries++;
}

function setUserRank($userID, $tarRank) {
	global $userData;
	if(getOrderOfRank($tarRank)>=getOrderOfRank($userData['rankID'])||getOrderOfRank($tarRank)==0) { // Attempting to Promote User to your rank or above, or into pre-login rank
		addFailureNotice("Permission Denied");
	}
	elseif(getOrderOfRank(getUserRank($userID))>=getOrderOfRank($userData['rankID'])) { // Attempting to demote someone of your rank or above
		addFailureNotice("Permission Denied");
	} else {
	
	global $con, $sqlQueries;
	$sql = "UPDATE accounts SET rankID='$tarRank' WHERE actID='$userID'";
	$result = mysqli_query($con,$sql) or die ("Query failed: setUserRank");
	$sqlQueries++;
	addSuccessNotice("Changed ".getMemberName($pageID2)."'s Rank");
	}
}

function getChangeRankList($actID) {
	global $siteSettings;
	$formURL=$siteSettings['siteURLShort']."membersList/changeUserRank/".$actID."/";
	displayChangeRankList($formURL,$actID);
}

function getChangeRankListOptions($actID) {
	global $con, $sqlQueries; // User ID
	
	// Get Users Rank ID
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = mysqli_query($con, $sql) or die ("Query failed: getChangeRankListOptions-Account");
	$sqlQueries++;
	$resultArray=mysqli_fetch_array($result);
	$userRank=$resultArray['rankID'];
	
	// Display Rank List With Current Rank Selected
	$sql = "SELECT * FROM ranks ORDER BY rankOrder";
	$result = mysqli_query($con, $sql) or die ("Query failed: getChangeRankListOptions-Ranks");
	$sqlQueries++;
	while($rank = mysqli_fetch_array($result)) {
		if($rank['rankID']==$userRank) { $optSelected="selected"; } else { $optSelected=""; }
		displayChangeRankListOption($rank['rankName'], $rank['rankID'], $optSelected);
	}
}

function getOrderOfRank($rankID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM ranks WHERE rankID='$rankID'";
	$result = mysqli_query($con, $sql) or die ("Query failed: getOrderOfRank");
	$sqlQueries++;
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['rankOrder'];
}
?>