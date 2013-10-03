<?php
// Harris Christiansen
// Created 5-29-13

// Account Security Functions

function userIsBanned() {
	global $userData;
	$ipAddress=returnRemoteIP();
	$userActID=$userData['actID'];
	$sql = "SELECT * FROM bannedClients WHERE ipAdr='$ipAddress' OR actID='$userActID'";
	$result = dbQuery($sql) or die ("Query failed: userIsBanned");
	if(mysqli_num_rows($result)==0) { // User Not Banned
		return false;
	} else {
		$resultArray=mysqli_fetch_array($result);
		$daysUntilBanExpires=$resultArray['banInitDay']+$resultArray['banLength']-returnDayCount();
		if($daysUntilBanExpires>0) { // Ban Still In Effect
			addFailureNotice("You Are Currently Suspended From The Site");
			addFailureNotice("Reason For Suspension: ".$resultArray['banReason']);
			addFailureNotice("Days Until Suspension Expires: ".$daysUntilBanExpires);
			setAccountToDefault();
			return true;
		} else { // Ban Has Expired
			$sql = "DELETE FROM bannedClients WHERE ipAdr='$ipAddress' OR actID='$userActID'";
			$result = dbQuery($sql) or die ("Query failed: userIsBanned - removeBan");
			addSuccessNotice("Your Suspension Has Expried!");
			return false;
		}
	}
}

function cleanInput($input) {
	global $con;
	return mysqli_real_escape_string($con, $input);
}
?>