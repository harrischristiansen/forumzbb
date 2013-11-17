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
	$output = mysqli_real_escape_string($con, $input);
	$fix[0]="<"; $fixed[0]="&lt;";
	$fix[1]=">"; $fixed[1]="&gt;";
	$fix[2]="\'"; $fixed[2]="&#39;";
	$fix[3]='\"'; $fixed[3]="&quot;";
	$output=str_replace($fix, $fixed, $output);
	return $output;
}

function isEmailValid($emailAdr) {
	$emailAdr = str_replace(' ', '', $emailAdr);
	$emailAdrs = split(',', $emailAdr);
	for($i=0;$i<count($emailAdrs);$i++) {
		if(!filter_var($emailAdrs[$i], FILTER_VALIDATE_EMAIL)) {
			return false;
		}
	}
	return true;
}

function userCan($permission) {
	global $userData;
	if($userData['permissions'][$permission]=="true") {
		return true;
	}
	return false;
}
?>