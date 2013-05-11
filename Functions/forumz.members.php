<?php
// Harris Christiansen
// Created 9-15-12
// Updated 10-30-12

// Members List and Member Info Systems


function getListActiveMembers() {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM accounts WHERE actStatus='0' ORDER BY username";
	$result = mysqli_query($con,$sql) or die ("Query failed: getListActiveMembers");
	$sqlQueries++;
	return $result;
}

function getRankName($rankID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM ranks WHERE rankID='$rankID'";
	$result = mysqli_query($con,$sql) or die ("Query failed: getRankName");
	$sqlQueries++;
	$resultArray=mysqli_fetch_array($result);
	if($resultArray['rankName']!="") {
		return $resultArray['rankName'];
	} else {
		return "Error: Unknown Rank";
	}
}

function displayMembersList() {
	global $userData;
	
	// Get List Of Members
	$rowID=1;
	$activeMembers=getListActiveMembers();
	
	// Run While Statement For Each Member
	while($member = mysqli_fetch_array($activeMembers)) {
		if($userData['loggedIn']&&$userData['permissions']['editMemberRank']=="true") {
			$cngRankFormDisplay=true;
		} else { $cngRankFormDisplay=false; }
		displayMembersListRow($member['username'], getRankName($member['rankID']), $member['joinDate'], $member['actID'], $rowID, $cngRankFormDisplay);
		$rowID++;
	}
}

function getMemberName($actID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = mysqli_query($con,$sql) or die ("Query failed: getMemberName");
	$sqlQueries++;
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['username'];
}
?>