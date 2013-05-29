<?php
// Harris Christiansen
// Created 9-15-12
// Updated 5-29-13

// Members List and Member Info Systems


function getListActiveMembers() {
	$sql = "SELECT * FROM accounts WHERE actStatus='0' ORDER BY username";
	$result = dbQuery($sql) or die ("Query failed: getListActiveMembers");
	return $result;
}

function getRankName($rankID) {
	global $rankNameList;
	if(isset($rankNameList[$rankID])) {
		return $rankNameList[$rankID];
	} else {
		$sql = "SELECT * FROM ranks WHERE rankID='$rankID'";
		$result = dbQuery($sql) or die ("Query failed: getRankName");
		$resultArray=mysqli_fetch_array($result);
		if($resultArray['rankName']!="") {
			$rankNameList[$rankID]=$resultArray['rankName'];
			return $resultArray['rankName'];
		} else {
			$rankNameList[$rankID]="Error: Unknown Rank";
			return "Error: Unknown Rank";
		}
	}
}

function displayMembersList() {
	global $userData;
	// Get List Of Members
	$rowID=1;
	$activeMembers=getListActiveMembers();
	
	// Run While Statement For Each Member
	while($member = mysqli_fetch_array($activeMembers)) {
		displayMembersListRow($member['username'], getRankName($member['rankID']), $member['joinDate'], $member['actID'], $rowID, hasPermissionToEditRank($member['rankID']));
		$rowID++;
	}
}

function getMemberName($actID) {
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: getMemberName");
	$resultArray=mysqli_fetch_array($result);
	return $resultArray['username'];
}
?>