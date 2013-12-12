<?php
// Harris Christiansen
// Created 9-15-12

// Account Creation and Login Systems
// Callable Functions: loginUser(), logoutUser(), registerUser(), sendConfirmationEmail($user, $email)

function setAccountToDefault() {
	global $userData;
	$userData['username']="Anonymous";
	$userData['loggedIn']=false;
	$userData['actID']="Anonymous";
	$userData['rankID']=0;
	$userData['email']="-";
}
function loginUser() {
	global $userData, $pagePost;
	$user=$pagePost['username'];
	$pass=$pagePost['password'];
	
	// Check Account Login Information And Status
	$loginStatus=checkLogin($user, $pass);
	
	// User Not Found
	if($loginStatus==-1) {
		addFailureNotice("Error: Invalid Username Or Password");
		unset($userData);
		
		// Failed Login Lockout
		if(!isset($_SESSION['failedLogins'])) { $_SESSION['failedLogins']=1; }
		else { $_SESSION['failedLogins']++; }
		if($_SESSION['failedLogins']==5) {
			addFailureNotice("This Account Has Been Locked - Please check your email for a reactivation link");
			setAccountAsLocked($user);
			$actID = getActID($user);
			$emailAdr = getUserEmail($user);
			$pass = getUserEncryptedPass($user);
			$siteName = getSiteName();
			$siteAddress = getSiteAddress();
			$emailMsg = 'Your Account On '.$siteName.' Has Been Locked Due To Suspicious Activity <br><br>
			<b style="color: red;">Activate Account: </b>You must reactivate your account by clicking the following link before you may login:<br><a href="http://'.$siteAddress.'/confirmAccount/'.$actID.'/'.$pass.'">http://'.$siteAddress.'/confirmAccount/'.$actID.'/'.$pass.'</a>';
			$emailSubject = 'Account Locked - '.$user;
			sendEmail($emailAdr, $emailSubject, $emailMsg);
		}
	}
	
	// User Found, Allowed To Login
	elseif($loginStatus==0) {
		global $emailActName;
		if(isset($emailActName)) {
			$userData['username'] = ucwords($emailActName); // For users that use email to login
		} else {
			$userData['username'] = ucwords($user);
		}
		$userData['loggedIn'] = true;
		setUserPrivileges();
		$_SESSION['failedLogins']=0; // Clear Failed Login Lockout
		addSuccessNotice("Success: You Are Now Logged In");
	}
	
	// User Has Not Verified Login
	elseif($loginStatus==1) { addFailureNotice("Error: You Must Activate Your Account Before You Can Login - An Activation Link Has Been Sent To Your Email"); unset($userData); }
	
	// Admin Has Not Verified Login
	elseif($loginStatus==2) { addFailureNotice("Error: An Admin Must Verify Your Account Before You Can Login"); unset($userData); }
	
	// Admin Has Not Verified Login
	elseif($loginStatus==12) { addFailureNotice("Error: You Must Both Verify Your Email And Be Approved By An Admin"); unset($userData); }
	
	// Account Banned
	elseif($loginStatus==3) { addFailureNotice("Error: The Account Is Currently Banned From The System"); unset($userData); }
	
}
function checkLogin($user, $pass) {
	global $userData;
	
	// Clean User Inputed Data
	$user = cleanInput($user);
	$pass = cleanInput($pass);
	$pass = md5($pass);
	
	// Store Login Date and IP-Address
	updateLoginReport($user);
	
	// Check to see if login information is valid
	$sql = "SELECT * FROM accounts WHERE username='$user' AND password='$pass'";
	$result = dbQuery($sql) or die ("Query failed: checkUserLogin");
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
		$result = dbQuery($sql) or die ("Query failed: checkEmailLogin");
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
function updateLoginReport($user) {
	$lastLoginDate=returnDateOfficial();
	$lastLoginIP=returnRemoteIP();
	$sql = "UPDATE accounts SET lastLogin='$lastLoginDate',lastLoginIP='$lastLoginIP' WHERE username='$user' OR email='$user'";
	$result = dbQuery($sql) or die ("Query failed: updateLoginReport");
}



function logoutUser() {
	global $userData;
	setAccountToDefault();
	setUserPrivileges();
	addSuccessNotice("You are now logged out.");
}
function registerUser() {
	global $pagePost, $siteSettings;
	$user=ucwords(cleanInput($pagePost['username']));
	$pass=cleanInput($pagePost['password']);
	$passCon=cleanInput($pagePost['passwordCon']);
	$email=cleanInput($pagePost['email']);
	
	if($pagePost['registerSubmitted']=="Register") {
		// Check To Make Sure Form Is All Filled Out
		if($user==""||$pass==""||$passCon==""||$email=="") {
			addFailureNotice("ERROR: Please fill out all parts of the form.");
		}
		elseif(strpos($user," ")!==false||strpos($pass," ")!==false||strpos($passCon," ")!==false||strpos($email," ")!==false) {
			addFailureNotice("ERROR: No spaces are allowed in the username, password, or email address.");
		}
		elseif(!isEmailValid($email)) {
			addFailureNotice("Invalid Email Address");
		}
		
		
		// Check To Make Sure Passwords Match
		elseif($pass!=$passCon) { addFailureNotice("ERROR: Passwords dont match."); }
		
		// Add User To Database
		else {
			if (addUserToDatabase($user, $pass, $email)) {
				addSuccessNotice("You Are Now Registered.");
				$actID = getActID($user);
				$siteName = getSiteName();
				$siteAddress = getSiteAddress();
				$emailMsg = "Welcome To $siteName! <br><br> An account has been created for you: <br><b>Website: </b>$siteAddress <br><b>Username: </b>$user <br><b>Password: </b>$pass";
				if($siteSettings['verifyRegisterEmail']) {
					$emailMsg .= '<br><br><b style="color: red;">NOTICE: </b>You must confirm your account before you may login:<br><a href="http://'.$siteAddress.'/confirmAccount/'.$actID.'/'.md5($pass).'">http://'.$siteAddress.'/confirmAccount/'.$actID.'/'.md5($pass).'</a>';
					addFailureNotice("You must confirm your account before you may login. An activation link has been sent to your email.");
				}
				$emailSubject = 'Account Created - '.$user;
				sendEmail($email, $emailSubject, $emailMsg);
			}
		}
	} else {
		addFailureNotice("ERROR: registerUser called, but form did not appear to be submitted.");
	}
}
function addUserToDatabase($user, $pass, $email) {
	global $siteSettings;
	
	// Clean User Inputed Data
	$pass = md5($pass);
	
	// Check Username
	if(checkUsernameAvailable($user)) {
		// Get Default User Account Status
		$actStatus=getDefaultAccountStatus();
		$userID = getSiteNumMembers();
		$joinDate = returnDateOfficial();
		$ipAddress = returnRemoteIP();
		$rankID = getRankByOrder(1);
		
		// Add Username To Database
		$sql = "INSERT INTO accounts (actID, username, password, email, actStatus, rankID, joinDate, joinIP) VALUES ('$userID','$user','$pass','$email', '$actStatus', '$rankID', '$joinDate', '$ipAddress')";
		$result = dbQuery($sql) or die ("Query failed: addUserToDatabase");
		return true;
	} else {
		addFailureNotice("Username Unavailable - We are sorry, that username is already taken.");
		return false;
	}
}
// Checks if user with specified name exists
function checkUsernameAvailable($user) {
	$sql = "SELECT * FROM accounts WHERE username='$user'";
	$result = dbQuery($sql) or die ("Query failed: checkUsernameAvailable");
	$users=mysqli_num_rows($result);
	if($users=="0") {
		return true;
	} return false;
}

//// Account Status Admin
function confirmAccount() { // Fix to not work for banned acts and acts with admin accept req
	global $pageID, $pageID2;
	$sql = "SELECT * FROM accounts WHERE actID='$pageID' AND password='$pageID2'";
	$result = dbQuery($sql) or die ("Query failed: confirmAccount-select");
	if(mysqli_num_rows($result)==0) {
		addFailureNotice("Invalid Activation Link");
	} else {
		setAccountAsConfirmedByEmail($pageID);
	}
}
function setAccountAsConfirmedByEmail($actID) {
	// Make so it only confirms email, not just sets account to active.
	setAccountAsActive($actID);
	addSuccessNotice("Account Activated - You May Now Login");
}
function setAccountAsConfirmedByAdmin($actID) {
	// Make so it only confirms by admin, not just sets account to active.
	setAccountAsActive($actID);
}
function setAccountAsActive($actID) {
	$sql = "UPDATE accounts SET actStatus='0' WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: setAccountAsActive");
}
function setAccountAsLocked($actID) {
	$sql = "UPDATE accounts SET actStatus='1' WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: setAccountAsLocked");
}
function setAccountAsBanned($actID) {
	$sql = "UPDATE accounts SET actStatus='-1' WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: setAccountAsBanned");
}

//// Reset Password ////

function resetPassword() {
	global $pagePost;
	$user=cleanInput($pagePost['username']);
	if(checkUsernameAvailable($user)) { addFailureNotice("Account Not Found"); }
	else {
		// Get New Pass
		$chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
		$newPass="";
		for($i=0;$i<8;$i++) {
			$randNum=rand(0,63);
			$newPass=$newPass.$chars[$randNum];
		}
		
		// Email New Pass
		$email = getUserEmail($user);
		$emailMsg = "Your password has been reset. Your new password is: ".$newPass." (case sensitive)";
		$emailSubject = 'Password Reset - '.$user;
		sendEmail($email, $emailSubject, $emailMsg);
		
		// Reset New Pass
		$newPass = md5($newPass);
		$sql = "UPDATE accounts SET password='$newPass' WHERE username='$user'";
		$result = dbQuery($sql) or die ("Query failed: resetPassword");
		
		// Confirm Password Reset
		addSuccessNotice("Password Reset - A New Password Has Been Emailed To You");
	}
}

//// Change Email ////
function changeEmail() {
	global $pageID,$userData;
	$changeData = str_replace("-at-","@",$pageID);
	$changeData = str_replace("-dot-",".",$changeData);
	$changeData = explode('-',$changeData);
	$userID = $changeData[0];
	$userPass = $changeData[1];
	$emailAdr = $changeData[2];
	$emailEnc = $changeData[3];
	
	$sql = "SELECT * FROM accounts WHERE actID='$userID' AND password='$userPass'";
	$result = dbQuery($sql) or die ("Query failed: changeEmail-selectAccount");
	if(mysqli_num_rows($result)==0) {
		addFailureNotice("Invalid Target Account");
	} elseif(md5($emailAdr)!=$emailEnc) {
		addFailureNotice("Invalid Target Address");
	} else {
		$sql = "UPDATE accounts SET email='$emailAdr' WHERE actID='$userID'";
		$result = dbQuery($sql) or die ("Query failed: changeEmail");
		$userData['email']=$emailAdr;
		addSuccessNotice("Email Address Changed");
	}
}

//// Get Ranks ////

function getUserRank($actID) {
	$sql = "SELECT * FROM accounts WHERE actID='$actID'";
	$result = dbQuery($sql) or die ("Query failed: getUserRank");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['rankID'];
}

function getRankByOrder($orderID) {
	$sql = "SELECT * FROM ranks WHERE rankOrder='$orderID'";
	$result = dbQuery($sql) or die ("Query failed: getRankByOrder");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['rankID'];
}
?>