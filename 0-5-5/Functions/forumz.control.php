<?php
// Harris Christiansen
// Created 10-10-12

function displayCPNav() {
	global $siteSettings;
	displayCPNavItem("Change Password",$siteSettings['siteURLShort']."controlPanel/changePassword/");
	displayCPNavItem("Edit Profile",$siteSettings['siteURLShort']."controlPanel/editProfile/");
	displayCPNavItem("Change Preferences",$siteSettings['siteURLShort']."controlPanel/changePreferences/");
	if(userCan('editSiteSettings')) {
		displayCPNavItem("Edit Site Settings",$siteSettings['siteURLShort']."controlPanel/editSiteSettings/");
	}
	if(userCan('editRanks')) {
		displayCPNavItem("Edit Ranks",$siteSettings['siteURLShort']."controlPanel/editRanks/");
	}
}

function displayCPContent() {
	global $pageID, $siteSettings, $pagePost;
	$siteURL=$siteSettings['siteURLShort'];
	$pageNotFound=true;
	
	// Common Pages
	if($pageID=="changePassword") { changePasswordForm($siteURL); $pageNotFound=false; }
	elseif($pageID=="editProfile") { editProfileForm($siteURL,$userData['email']); $pageNotFound=false; }
	elseif($pageID=="changePreferences") { changePreferencesForm($siteURL); $pageNotFound=false; }
	
	// Permission Restricted Pages
	if(userCan('editSiteSettings')) {
		if($pageID=="editSiteSettings") {
			global $siteSettings;
			$pageNotFound=false;
			if($siteSettings['reqLogin']) { $reqLoginChecked="checked"; }
			else { $reqLoginChecked=""; }
			editSiteSettingsForm($siteURL, $siteSettings['siteName'], reverseFormatPost($siteSettings['siteMotd']), reverseFormatPost($siteSettings['siteSlogan']), reverseFormatPost($siteSettings['disabledMessage']), $reqLoginChecked, $siteSettings['blogEntriesPerPage']);
		}
	}
	if(userCan('editRanks')) {
		if($pageID=="addRank") { editRanksForm($siteURL,"","",""); $pageNotFound=false; }
		if($pageID=="editRanks"||$pageID=="swapRanks") { editRanksControlPanel(); $pageNotFound=false; }
	}
	
	// Page Not Found
	if($pageNotFound) { viewHTML('Please Select An Item From The Menu On The Left.'); }
}

function updateAccountPassword() {
	global $pagePost;
	// Get Username From Session, Passwords From Form
	$username=returnUsername();
	$accountID=returnUserID();
	$oldPass=$pagePost['oldPass'];
	$newPass=$pagePost['newPass'];
	$newPassCon=$pagePost['newPassCon'];
	$newPassEncrypted=md5($newPass);
	// Check To Make Sure Password Matches Username
	if(checkLogin($username, $oldPass)==-1) {
		addFailureNotice("Invalid Password: Old Password Did Not Match");
	}
	// Check To Make Sure New Passwords match
	elseif($newPass!=$newPassCon) {
		addFailureNotice("Error: New Passwords Did Not Match");
	}
	// Change Password
	else {
		$sql = "UPDATE accounts SET password='$newPassEncrypted' WHERE actID='$accountID'";
		$result = dbQuery($sql) or die ("Query failed: updateAccountPassword");
		addSuccessNotice("Success: Password Changed");
	}
}

function updateAccountProfile() {
	global $pagePost;
	$accountID = returnUserID();
	$user = returnUsername();
	$actPass = returnUserPass();
	$newEmail = cleanInput($pagePost['newEmail']);
	$newEmailToSend = str_replace("@","-at-",$newEmail);
	$newEmailToSend = str_replace(".","-dot-",$newEmailToSend);
	$newEmailMD5 = md5($newEmail);
	$activationLink = getSiteAddress().'/changeEmail/'.$accountID.'-'.$actPass.'-'.$newEmailToSend.'-'.$newEmailMD5.'/';
	if($newEmail!=returnUserEmail()) {
		$emailMsg = 'The contact information for account "'.$user.'" was recently updated to this email address.<br>Please confirm this address using the following link<br><br><a href="http://'.$activationLink.'">'.$activationLink.'</a>';
		$emailSubject = 'Account Contact Info Updated - '.$user;
		sendEmail($newEmail, $emailSubject, $emailMsg);
		addFailureNotice("A contact info change confirmation has been emailed to your new address. Please confirm this change using the emailed link.");
	}
	/*$sql = "UPDATE accounts SET email='$newEmail' WHERE actID='$accountID'";
	$result = dbQuery($sql) or die ("Query failed: updateAccountProfile");*/
	addSuccessNotice("Success: Profile Updated");
}

function updateAccountPreferences() {
	global $pagePost, $userData;
	$accountID = returnUserID();
	$themePref = cleanInput($pagePost['siteTheme']);
	$sql = "UPDATE accounts SET themePref='$themePref' WHERE actID='$accountID'";
	$result = dbQuery($sql) or die ("Query failed: updateAccountPreferences");
	$userData['themePref']=$themePref;
	addSuccessNotice("Success: Preferences Updated");
}

function getUserThemeOptions() {
	global $userData;
	$sql = "SELECT * FROM themes ORDER BY themeName";
	$result = dbQuery($sql) or die ("Query failed: getSiteThemeOptions");
	while($resultArray=mysqli_fetch_array($result)) {
		if($resultArray['themeAddress']!=$userData['themePref']) {
			$returnValue=$returnValue.'<option value="'.$resultArray['themeAddress'].'">'.$resultArray['themeName'].'</option>';
		} else {
			$returnValue=$returnValue.'<option value="'.$resultArray['themeAddress'].'" selected>'.$resultArray['themeName'].'</option>';
		}
	}
	return $returnValue;
}

function updateSiteSettings() {
	global $pagePost;
	$siteName=cleanInput($pagePost['siteName']);
	$siteVersion=cleanInput($pagePost['siteVersion']);
	$siteTheme=cleanInput($pagePost['siteTheme']);
	$siteMotd=formatPost($pagePost['siteMotd']);
	$siteSlogan=formatPost($pagePost['siteSlogan']);
	$siteDisabled=formatPost($pagePost['siteDisabled']);
	$reqLogin=cleanInput($pagePost['reqLogin']);
	$numBlogEntriesPerPage=cleanInput($pagePost['numBlogEntriesPerPage']);
	
	$sql = "UPDATE siteSettings SET siteName='$siteName', siteVersion='$siteVersion', defaultTheme='$siteTheme', siteMotd='$siteMotd', siteSlogan='$siteSlogan', siteDisabled='$siteDisabled', reqLogin='$reqLogin', blogEntriesPerPage='$numBlogEntriesPerPage' WHERE settingsProfile='1'";
	$result = dbQuery($sql) or die ("Query failed: updateSiteSettings");
	
	loadSiteSettings(); // To Refresh Site Settings
	addSuccessNotice("Success: Site Settings Updated");
}

function getSiteVersionOptions() {
	global $siteSettings;
	$sql = "SELECT * FROM siteSettings WHERE settingsProfile='0' ORDER BY siteVersion DESC";
	$result = dbQuery($sql) or die ("Query failed: getSiteVersionOptions");
	$returnValue="";
	while($resultArray=mysqli_fetch_array($result)) {
		if($resultArray['siteVersion']!=$siteSettings['siteVersion']) {
			$returnValue=$returnValue.'<option value="'.$resultArray['siteVersion'].'">'.$resultArray['siteName'].'</option>';
		} else {
			$returnValue=$returnValue.'<option value="'.$resultArray['siteVersion'].'" selected>'.$resultArray['siteName'].'</option>';
		}
	}
	return $returnValue;
}

function getSiteThemeOptions() {
	global $siteSettings;
	$sql = "SELECT * FROM themes ORDER BY themeName";
	$result = dbQuery($sql) or die ("Query failed: getSiteThemeOptions");
	while($resultArray=mysqli_fetch_array($result)) {
		if($resultArray['themeAddress']!=$siteSettings['defaultTheme']) {
			$returnValue=$returnValue.'<option value="'.$resultArray['themeAddress'].'">'.$resultArray['themeName'].'</option>';
		} else {
			$returnValue=$returnValue.'<option value="'.$resultArray['themeAddress'].'" selected>'.$resultArray['themeName'].'</option>';
		}
	}
	return $returnValue;
}

function getNumSiteRanks() {
	$sql = "SELECT * FROM ranks";
	$result = dbQuery($sql) or die ("Query failed: getNumSiteRanks");
	return mysqli_num_rows($result);
}

function editRanksControlPanel() {
	global $siteSettings, $pageID2;
	$siteURL=$siteSettings['siteURLShort'];
	$sql = "SELECT * FROM ranks WHERE rankID='$pageID2'";
	$result = dbQuery($sql) or die ("Query failed: editRanksControlPanel");
	$rankArray = mysqli_fetch_array($result);
	$permissionsArray = unserialize($rankArray['permissions']);
	
	
	// Get Checked Items
	// Admin
	if($permissionsArray['editSiteSettings']=="true") { $settingChecked['editSiteSettings']="checked"; } else { $settingChecked['editSiteSettings']=""; }
	if($permissionsArray['editMemberRank']=="true") { $settingChecked['editMemberRank']="checked"; } else { $settingChecked['editMemberRank']=""; }
	if($permissionsArray['editRanks']=="true") { $settingChecked['editRanks']="checked"; } else { $settingChecked['editRanks']=""; }
	if($permissionsArray['viewMembersList']=="true") { $settingChecked['viewMembersList']="checked"; } else { $settingChecked['viewMembersList']=""; }
	// Blog
	if($permissionsArray['postBlogEntries']=="true") { $settingChecked['postBlogEntries']="checked"; } else { $settingChecked['postBlogEntries']=""; }
	if($permissionsArray['postBlogComments']=="true") { $settingChecked['postBlogComments']="checked"; } else { $settingChecked['postBlogComments']=""; }
	if($permissionsArray['editBlogEntries']=="true") { $settingChecked['editBlogEntries']="checked"; } else { $settingChecked['editBlogEntries']=""; }
	if($permissionsArray['deleteBlogEntries']=="true") { $settingChecked['deleteBlogEntries']="checked"; } else { $settingChecked['deleteBlogEntries']=""; }
	if($permissionsArray['editBlogComments']=="true") { $settingChecked['editBlogComments']="checked"; } else { $settingChecked['editBlogComments']=""; }
	if($permissionsArray['deleteBlogComments']=="true") { $settingChecked['deleteBlogComments']="checked"; } else { $settingChecked['deleteBlogComments']=""; }
	// Forums
	if($permissionsArray['viewForum']=="true") { $settingChecked['viewForum']="checked"; } else { $settingChecked['viewForum']=""; }
	if($permissionsArray['createForumThreads']=="true") { $settingChecked['createForumThreads']="checked"; } else { $settingChecked['createForumThreads']=""; }
	if($permissionsArray['createForumPosts']=="true") { $settingChecked['createForumPosts']="checked"; } else { $settingChecked['createForumPosts']=""; }
	if($permissionsArray['editForumPosts']=="true") { $settingChecked['editForumPosts']="checked"; } else { $settingChecked['editForumPosts']=""; }
	if($permissionsArray['deleteForumPosts']=="true") { $settingChecked['deleteForumPosts']="checked"; } else { $settingChecked['deleteForumPosts']=""; }
	if($permissionsArray['manageForums']=="true") { $settingChecked['manageForums']="checked"; } else { $settingChecked['manageForums']=""; }
	// Chat
	if($permissionsArray['useChat']=="true") { $settingChecked['useChat']="checked"; } else { $settingChecked['useChat']=""; }
	
	
	// Display Form
	editRanksForm($siteURL,$rankArray['rankID'],$rankArray['rankName'],$settingChecked);
}

function displayRankNavItems() {
	global $siteSettings,$userData;
	$siteURL=$siteSettings['siteURLShort'];
	$sql = "SELECT * FROM ranks ORDER BY rankOrder";
	$result = dbQuery($sql) or die ("Query failed: displayRankNavItems");
	
	while($rank = mysqli_fetch_array($result)) {
		$rankLink=$siteSettings['siteURLShort']."controlPanel/editRanks/".$rank['rankID']."/";
		if($rank['rankID']=="0") {
			displayRankNavItem("Unregistered User",$rankLink,"","");
		} else {
			// When To Show Up Arrow
			$upArrLink="";
			if($rank['rankOrder']>1&&$userData['permissions']['rankOrder']>$rank['rankOrder']) {
				$upArrLink=$siteURL."controlPanel/swapRanks/".$rank['rankID']."u";
			}
			// When To Show Dn Arrow
			$dnArrLink="";
			if($rank['rankOrder']>0&&$userData['permissions']['rankOrder']>($rank['rankOrder']+1)) {
				$dnArrLink=$siteURL."controlPanel/swapRanks/".$rank['rankID']."d";
			}
			displayRankNavItem($rank['rankName'],$rankLink,$upArrLink,$dnArrLink);
		}
	}
	$rankLink=$siteSettings['siteURLShort']."controlPanel/addRank/";
	displayRankNavItem("Add Rank",$rankLink,"","");
}

// Both need to confirm that only highest ranking member can edit ranks permissions
function addSiteRank() {
	global $pagePost, $con, $userData;
	$rankName=cleanInput($pagePost['rankName']);
	$rankID=getNumSiteRanks();
	$highestRankOrder=getHighestRankOrder();
	$newHighestRankOrder=$highestRankOrder+1;
	if(getHighestRankID()!=$userData['rankID']) {
		addFailureNotice("Permission Denied");
	} else {
		$sql = "UPDATE ranks SET rankOrder='$newHighestRankOrder' WHERE rankOrder='$highestRankOrder'"; // Move Admin Rank Forward One Position
		$result = dbQuery($sql) or die ("Query failed: addSiteRank-moveAdminRank");
		$sql = "INSERT INTO ranks (rankID, rankOrder, rankName) VALUES ('$rankID','$highestRankOrder','$rankName')";
		$result = dbQuery($sql) or die ("Query failed: addSiteRank-addRank");
		addSuccessNotice("Success: Rank Added");
	}
}

function updateRank() {
	global $pagePost, $pageID2, $con, $userData;
	$tarRank=$pageID2;
	$rankName=cleanInput($pagePost['rankName']);
	// Admin
	$newPermissions['editSiteSettings']=cleanInput($pagePost['editSiteSettings']);
	$newPermissions['editMemberRank']=cleanInput($pagePost['editMemberRank']);
	$newPermissions['editRanks']=cleanInput($pagePost['editRanks']);
	$newPermissions['viewMembersList']=cleanInput($pagePost['viewMembersList']);
	// Blog
	$newPermissions['postBlogEntries']=cleanInput($pagePost['postBlogEntries']);
	$newPermissions['postBlogComments']=cleanInput($pagePost['postBlogComments']);
	$newPermissions['editBlogEntries']=cleanInput($pagePost['editBlogEntries']);
	$newPermissions['deleteBlogEntries']=cleanInput($pagePost['deleteBlogEntries']);
	$newPermissions['editBlogComments']=cleanInput($pagePost['editBlogComments']);
	$newPermissions['deleteBlogComments']=cleanInput($pagePost['deleteBlogComments']);
	// Forums
	$newPermissions['viewForum']=cleanInput($pagePost['viewForum']);
	$newPermissions['createForumThreads']=cleanInput($pagePost['createForumThreads']);
	$newPermissions['createForumPosts']=cleanInput($pagePost['createForumPosts']);
	$newPermissions['editForumPosts']=cleanInput($pagePost['editForumPosts']);
	$newPermissions['deleteForumPosts']=cleanInput($pagePost['deleteForumPosts']);
	$newPermissions['manageForums']=cleanInput($pagePost['manageForums']);
	// Chat
	$newPermissions['useChat']=cleanInput($pagePost['useChat']);
	
	if(getOrderOfRank($tarRank)>=getOrderOfRank($userData['rankID'])&&getHighestRankID()!=$userData['rankID']) { // Attempting to Edit Rank Greater Than Own
		addFailureNotice("Permission Denied");
	} elseif(getHighestRankID()!=$userData['rankID']) { // Only Highest Rank Can Change Permissions
		$sql = "UPDATE ranks SET rankName='$rankName' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank");
		addSuccessNotice("Success: Rank Updated");
	} else {
		$newPermissionsSave = serialize($newPermissions);
		$sql = "UPDATE ranks SET rankName='$rankName', permissions='$newPermissionsSave' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank");
		
		addSuccessNotice("Success: Rank Updated");
	}
}

function swapRanks() { // For Ordering Ranks
	global $pageID2;
	$origRankID=preg_replace("/[^1-9]/","", $pageID2);
	$rankDir=preg_replace("/[^a-zA-Z]/","", $pageID2);
	
	$origRankOrder=getOrderOfRank($origRankID);
	$tarRankOrder="";
	if($rankDir=="u") { $tarRankOrder=$origRankOrder-1; }
	if($rankDir=="d") { $tarRankOrder=$origRankOrder+1; }
	if(hasPermissionToEditRankOrder($origRankOrder)&&hasPermissionToEditRankOrder($tarRankOrder)&&$tarRankOrder!="") {
		$sql = "UPDATE ranks SET rankOrder='$origRankOrder' WHERE rankOrder='$tarRankOrder'";
		$result = dbQuery($sql) or die ("Query failed: swapRanks1");
		$sql = "UPDATE ranks SET rankOrder='$tarRankOrder' WHERE rankID='$origRankID'";
		$result = dbQuery($sql) or die ("Query failed: swapRanks2");
		addSuccessNotice("Success: Rank Order Updated");
	} else {
		addFailureNotice("Permission Denied");
	}
}
?>