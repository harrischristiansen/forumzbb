<?php
// Harris Christiansen
// Created 5-29-13

// Account Security Functions

function userIsBanned() {
	$ipAddress=returnRemoteIP();
	$userActID=returnUserID();
	$sql = "SELECT * FROM bannedClients WHERE ipAdr='$ipAddress' OR actID='$userActID'";
	$result = dbQuery($sql) or die ("Query failed: userIsBanned");
	if(mysqli_num_rows($result)==0) { // User Not Banned
		return false;
	} else {
		$resultArray=mysqli_fetch_array($result);
		$daysUntilBanExpires=$resultArray['banInitDay']+$resultArray['banLength']-returnDateOfficial();
		if($daysUntilBanExpires>0) { // Ban Still In Effect
			addFailureNotice("You Are Currently Suspended From The Site");
			addFailureNotice("Reason For Suspension: ".$resultArray['banReason']);
			addFailureNotice("Days Until Suspension Expires: ".$daysUntilBanExpires);
			setAccountToDefault();
			return true;
		} else { // Ban Has Expired
			$sql = "DELETE FROM bannedClients WHERE ipAdr='$ipAddress' OR actID='$userActID'";
			$result = dbQuery($sql) or die ("Query failed: userIsBanned - removeBan");
			addSuccessNotice("Notice: You account was recently suspended. Your suspension has been lifted!");
			return false;
		}
	}
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

function ipFlaggedAsSpam($ip){
	$failCount=0;
	$dnsbl_lookup=array("dnsbl-1.uceprotect.net","dnsbl-2.uceprotect.net","dnsbl-3.uceprotect.net","dnsbl.dronebl.org","dnsbl.sorbs.net","zen.spamhaus.org");
	$reverse_ip=implode(".",array_reverse(explode(".",$ip)));
	foreach($dnsbl_lookup as $host){
		if(checkdnsrr($reverse_ip.".".$host.".","A")){
			$failCount++;
		}
	}
	if($failCount>2) {
		return true;
	}
	return false;
}
?>