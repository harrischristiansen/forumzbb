<?php
// Harris Christiansen
// Created 2013-12-14

function returnUsername() {
	// Returns Username of current logged in user, "Anonymous" if not logged in.
	global $userData;
	if(isset($userData['username'])&&$userData['loggedIn']) {
		return ucwords($userData['username']);
	} else {
		return "Anonymous";
	}
}
function returnUserID() {
	// Returns actID
	global $userData;
	return $userData['actID'];
}
function returnUserPass() {
	// Returns actPass
	global $userData;
	$actID = $userData['actID'];
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: returnUserPass");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['password'];
}
/*
function returnUserEmail() { // Why?
	global $userData;
	$actID = $userData['actID'];
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: returnUserEmail");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['email'];
}
*/
function returnUserEmail() {
	global $userData;
	return $userData['email'];
}
function getActID($username) {
	$sql = "SELECT * FROM accounts WHERE username='$username'";
	$result = dbQuery($sql) or die ("Query failed: getActID");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['actID'];
}
function getUsername($userID) {
	$sql = "SELECT * FROM accounts WHERE actID='$userID'";
	$result = dbQuery($sql) or die ("Query failed: getUsername");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['username'];
}
function getUserEmail($user) {
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = dbQuery($sql) or die ("Query failed: getUserEmail");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['email'];
}
function getUserEncryptedPass($user) {
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = dbQuery($sql) or die ("Query failed: getUserEncryptedPass");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['password'];
}
function returnRemoteIP() {
	return $_SERVER['REMOTE_ADDR'];
}
function isLoggedIn() {
	// Returns true if user is logged in.
	global $userData;
	return $userData['loggedIn'];
}
?>