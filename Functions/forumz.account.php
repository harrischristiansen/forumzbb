<?php
// Harris Christiansen
// Created 9-15-12
// Updated 5-12-13

// Account Creation and Login Systems
// Callable Functions: loginUser(), logoutUser(), registerUser(), sendConfirmationEmail($user, $email)


function loginUser() {
	global $userData, $pagePost;
	$user=$pagePost['username'];
	$pass=$pagePost['password'];
	
	// Check Account Login Information And Status
	$loginStatus=checkLogin($user, $pass);
	
	// User Not Found
	if($loginStatus==-1) { addFailureNotice("Error: Invalid Username Or Password"); }
	
	// User Found, Allowed To Login
	elseif($loginStatus==0) {
		global $emailActName;
		if(isset($emailActName)) {
			$userData['username']=$emailActName; // For users that use email to login
		} else {
			$userData['username'] = $user;
		}
		$userData['loggedIn'] = true;
		setUserPrivileges();
		addSuccessNotice("Success: You Are Now Logged In");
	}
	
	// User Has Not Verified Login
	elseif($loginStatus==1) { addFailureNotice("Error: You Must Verify Your Email Before You Can Login"); }
	
	// Admin Has Not Verified Login
	elseif($loginStatus==2) { addFailureNotice("Error: An Admin Must Verify Your Account Before You Can Login"); }
	
	// Admin Has Not Verified Login
	elseif($loginStatus==12) { addFailureNotice("Error: You Must Both Verify Your Email And Be Approved By An Admin"); }
	
	// Account Banned
	elseif($loginStatus==3) { addFailureNotice("Error: The Account Is Currently Banned From The System"); }
	
}
function checkLogin($user, $pass) {
	global $con, $sqlQueries, $userData;
	
	// Clean User Inputed Data
	$user = mysqli_real_escape_string($con, $user);
	$pass = mysqli_real_escape_string($con, $pass);
	$pass = md5($pass);
	
	// Check to see if login information is valid
	$sql = "SELECT * FROM accounts WHERE username='$user' AND password='$pass'";
	$result = mysqli_query($con, $sql) or die ("Query failed: checkUserLogin");
	$sqlQueries++;
	$users=mysqli_num_rows($result);
	
	// Login Was Correct
	if($users==1) {
		$userInfo=mysqli_fetch_array($result);
		$actStatus = $userInfo['actStatus'];
		$userData['actID']=$userInfo['actID'];
		$userData['rankID']=$userInfo['rankID'];
		$userData['email']=$userInfo['email'];
		return $actStatus;
	} else { 
		$sql = "SELECT * FROM accounts WHERE email='$user' AND password='$pass'";
		$result = mysqli_query($con, $sql) or die ("Query failed: checkEmailLogin");
		$sqlQueries++;
		$users=mysqli_num_rows($result);
		if($users==1) {
			$userInfo=mysqli_fetch_array($result);
			$actStatus = $userInfo['actStatus'];
			global $userData;
			$userData['actID']=$userInfo['actID'];
			$userData['rankID']=$userInfo['rankID'];
			$userData['email']=$userInfo['email'];
			global $emailActName;
			$emailActName = $userInfo['username'];
			return $actStatus;
		} else { return -1; }
	}
}
function logoutUser() {
	global $userData;
	$userData['loggedIn'] = false;
	$userData['actID']=-1;
	$userData['rankID']=0;
	$userData['username']="loggedOut";
	addSuccessNotice("You are now logged out.");
}
function registerUser() {
	global $pagePost;
	$user=$pagePost['username'];
	$pass=$pagePost['password'];
	$passCon=$pagePost['passwordCon'];
	$email=$pagePost['email'];
	
	if($pagePost['registerSubmitted']=="Register") {
		// Check To Make Sure Form Is All Filled Out
		if($user==""||$pass==""||$passCon==""||$email=="") {
			addFailureNotice("ERROR: Please fill out all parts of the form.");
		}
		elseif(strpos($user," ")!==false||strpos($pass," ")!==false||strpos($passCon," ")!==false||strpos($email," ")!==false) {
			addFailureNotice("ERROR: No spaces are allowed in the username, password, or email address.");
		}
		
		
		// Check To Make Sure Passwords Match
		elseif($pass!=$passCon) { addFailureNotice("ERROR: Passwords dont match."); }
		
		// Add User To Database
		else { addUserToDatabase($user, $pass, $email); addSuccessNotice("You Are Now Registered."); }
	} else {
		addFailureNotice("ERROR: registerUser called, but form did not appear to be submitted.");
	}
}
function addUserToDatabase($user, $pass, $email) {
	global $con, $sqlQueries, $siteSettings;
	
	// Clean User Inputed Data
	$user = mysqli_real_escape_string($con, $user);
	$pass = mysqli_real_escape_string($con, $pass);
	$email = mysqli_real_escape_string($con, $email);
	$pass = md5($pass);
	
	// Check Username
	if(checkUsernameAvailable($user)) {
		// Get Default User Account Status
		$actStatus=getDefaultAccountStatus();
		$userID = getSiteNumMembers();
		$joinDate = returnDateShort();
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		
		// Add Username To Database
		$sql = "INSERT INTO accounts (actID, username, password, email, actStatus, rankID, joinDate, ipAddress) VALUES ('$userID','$user','$pass','$email', '$actStatus', '1', '$joinDate', '$ipAddress')";
		$result = mysqli_query($con, $sql) or die ("Query failed: addUserToDatabase");
		$sqlQueries++;
	} else {
		addFailureNotice("ERROR: Username Is Unavailable.");
	}
}
// Checks if user with specified name exists
function checkUsernameAvailable($user) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = mysqli_query($con, $sql) or die ("Query failed: checkUsernameAvailable");
	$sqlQueries++;
	$users=mysqli_num_rows($result);
	if($users=="0") {
		return true;
	} return false;
}
function sendConfirmationEmail($user, $msgTo) {
	global $siteSettings;
	$subject = "Account Confirmation: ".$siteSettings['siteName']." - ".$user;
	$message = $user.', please click the following link to confirm your email: <a href="http://www.forumzbb.com/">http://www.forumzbb.com/</a>';
	$headers = "From: noReply@forumzbb.com";
	
	mail($msgTo, $subject, $message, $headers);
}
function setAccountAsConfirmedByEmail($user) {
	// Make so it only confirms email, not just sets account to active.
	setAccountAsActive($user);
}
function setAccountAsConfirmedByAdmin($user) {
	// Make so it only confirms by admin, not just sets account to active.
	setAccountAsActive($user);
}
function setAccountAsActive($user) {
	global $con, $sqlQueries;
	$sql = "UPDATE accounts SET actStatus='0' WHERE username='$user'";
	$result = mysqli_query($con,$sql) or die ("Query failed: setAccountAsActive");
	$sqlQueries++;
}
function setAccountAsBanned($user) {
	global $con, $sqlQueries;
	$sql = "UPDATE accounts SET actStatus='-1' WHERE username='$user'";
	$result = mysqli_query($con,$sql) or die ("Query failed: setAccountAsBanned");
	$sqlQueries++;
}

function getUserRank($actID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = mysqli_query($con,$sql) or die ("Query failed: getUserRank");
	$sqlQueries++;
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['rankID'];
}
?>