<?php
// Harris Christiansen
// Created 10-10-12

function displayCPNav() {
	global $siteSettings, $userData;
	displayCPNavItem("Change Password",$siteSettings['siteURLShort']."controlPanel/changePassword/");
	displayCPNavItem("Edit Profile",$siteSettings['siteURLShort']."controlPanel/editProfile/");
	displayCPNavItem("Change Preferences",$siteSettings['siteURLShort']."controlPanel/changePreferences/");
	if($userData['permissions']['editSiteSettings']=="true") {
		displayCPNavItem("Edit Site Settings",$siteSettings['siteURLShort']."controlPanel/editSiteSettings/");
	}
	if($userData['permissions']['editRanks']=="true") {
		displayCPNavItem("Edit Ranks",$siteSettings['siteURLShort']."controlPanel/editRanks/");
	}
}

function displayCPContent() {
	global $pageID, $siteSettings, $pagePost, $userData;
	$siteURL=$siteSettings['siteURLShort'];
	$pageNotFound=true;
	
	// Common Pages
	if($pageID=="changePassword") { changePasswordForm($siteURL); $pageNotFound=false; }
	elseif($pageID=="editProfile") { editProfileForm($userData['email'],$siteURL); $pageNotFound=false; }
	elseif($pageID=="changePreferences") { changePreferencesForm($siteURL); $pageNotFound=false; }
	
	// Permission Restricted Pages
	if($userData['permissions']['editSiteSettings']=="true") {
		if($pageID=="editSiteSettings") {
			global $siteSettings;
			$pageNotFound=false;
			if($siteSettings['reqLogin']) { $reqLoginChecked="checked"; }
			else { $reqLoginChecked=""; }
			editSiteSettingsForm($siteURL, $siteSettings['siteName'], reverseFormatPost($siteSettings['siteMotd']), reverseFormatPost($siteSettings['siteSlogan']), reverseFormatPost($siteSettings['disabledMessage']), $reqLoginChecked, $siteSettings['blogEntriesPerPage']);
		}
	}
	if($userData['permissions']['editRanks']=="true") {
		if($pageID=="addRank") { editRanksForm($siteURL,"","",""); $pageNotFound=false; }
		if($pageID=="editRanks"||$pageID=="swapRanks") { editRanksControlPanel(); $pageNotFound=false; }
	}
	
	// Page Not Found
	if($pageNotFound) { viewHTML('Please Select An Item From The Menu On The Left.'); }
}

function updateAccountPassword() {
	global $userData, $pagePost;
	// Get Username From Session, Passwords From Form
	$username=$userData['username'];
	$accountID=$userData['actID'];
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
	global $userData, $pagePost, $con;
	$accountID=$userData['actID'];
	$newEmail=cleanInput($pagePost['newEmail']);
	$sql = "UPDATE accounts SET email='$newEmail' WHERE actID='$accountID'";
	$result = dbQuery($sql) or die ("Query failed: updateAccountProfile");
	addSuccessNotice("Success: Profile Updated");
}

function updateSiteSettings() {
	global $pagePost, $con;
	$siteName=cleanInput($pagePost['siteName']);
	$siteVersion=formatPost($pagePost['siteVersion']);
	$siteMotd=formatPost($pagePost['siteMotd']);
	$siteSlogan=formatPost($pagePost['siteSlogan']);
	$siteDisabled=formatPost($pagePost['siteDisabled']);
	$reqLogin=cleanInput($pagePost['reqLogin']);
	$numBlogEntriesPerPage=cleanInput($pagePost['numBlogEntriesPerPage']);
	
	$sql = "UPDATE siteSettings SET siteName='$siteName', siteVersion='$siteVersion', siteMotd='$siteMotd', siteSlogan='$siteSlogan', siteDisabled='$siteDisabled', reqLogin='$reqLogin', blogEntriesPerPage='$numBlogEntriesPerPage' WHERE settingsProfile='1'";
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
	
	
	// Get Checked Items
	// Admin
	if($rankArray['editSiteSettings']=="true") { $settingChecked['editSiteSettings']="checked"; } else { $settingChecked['editSiteSettings']=""; }
	if($rankArray['editMemberRank']=="true") { $settingChecked['editMemberRank']="checked"; } else { $settingChecked['editMemberRank']=""; }
	if($rankArray['editRanks']=="true") { $settingChecked['editRanks']="checked"; } else { $settingChecked['editRanks']=""; }
	// Blog
	if($rankArray['postBlogEntries']=="true") { $settingChecked['postBlogEntries']="checked"; } else { $settingChecked['postBlogEntries']=""; }
	if($rankArray['postBlogComments']=="true") { $settingChecked['postBlogComments']="checked"; } else { $settingChecked['postBlogComments']=""; }
	if($rankArray['editBlogEntries']=="true") { $settingChecked['editBlogEntries']="checked"; } else { $settingChecked['editBlogEntries']=""; }
	if($rankArray['deleteBlogEntries']=="true") { $settingChecked['deleteBlogEntries']="checked"; } else { $settingChecked['deleteBlogEntries']=""; }
	// Forums
	if($rankArray['createForumThreads']=="true") { $settingChecked['createForumThreads']="checked"; } else { $settingChecked['createForumThreads']=""; }
	if($rankArray['createForumPosts']=="true") { $settingChecked['createForumPosts']="checked"; } else { $settingChecked['createForumPosts']=""; }
	if($rankArray['editForumPosts']=="true") { $settingChecked['editForumPosts']="checked"; } else { $settingChecked['editForumPosts']=""; }
	if($rankArray['deleteForumPosts']=="true") { $settingChecked['deleteForumPosts']="checked"; } else { $settingChecked['deleteForumPosts']=""; }
	if($rankArray['manageForums']=="true") { $settingChecked['manageForums']="checked"; } else { $settingChecked['manageForums']=""; }
	
	
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
	$editSiteSettings=cleanInput($pagePost['editSiteSettings']);
	$editMemberRank=cleanInput($pagePost['editMemberRank']);
	$editRanks=cleanInput($pagePost['editRanks']);
	$postBlogEntries=cleanInput($pagePost['postBlogEntries']);
	$postBlogComments=cleanInput($pagePost['postBlogComments']);
	$editBlogEntries=cleanInput($pagePost['editBlogEntries']);
	$deleteBlogEntries=cleanInput($pagePost['deleteBlogEntries']);
	$rankID=getNumSiteRanks();
	$highestRankOrder=getHighestRankOrder();
	$newHighestRankOrder=$highestRankOrder+1;
	if(getHighestRankID()!=$userData['rankID']) {
		addFailureNotice("Permission Denied");
	} else {
		$sql = "UPDATE ranks SET rankOrder='$newHighestRankOrder' WHERE rankOrder='$highestRankOrder'"; // Move Admin Rank Forward One Position
		$result = dbQuery($sql) or die ("Query failed: addSiteRank-moveAdminRank");
		$sql = "INSERT INTO ranks (rankID, rankOrder, rankName, editSiteSettings, editMemberRank, editRanks, postBlogEntries, postBlogComments, editBlogEntries, deleteBlogEntries) VALUES ('$rankID','$highestRankOrder','$rankName','$editSiteSettings','$editMemberRank','$editRanks','$postBlogEntries','$postBlogComments','$editBlogEntries','$deleteBlogEntries')";
		$result = dbQuery($sql) or die ("Query failed: addSiteRank-addRank");
		addSuccessNotice("Success: Rank Added");
	}
}

function updateRank() {
	global $pagePost, $pageID2, $con, $userData;
	$tarRank=$pageID2;
	$rankName=cleanInput($pagePost['rankName']);
	// Admin
	$editSiteSettings=cleanInput($pagePost['editSiteSettings']);
	$editMemberRank=cleanInput($pagePost['editMemberRank']);
	$editRanks=cleanInput($pagePost['editRanks']);
	// Blog
	$postBlogEntries=cleanInput($pagePost['postBlogEntries']);
	$postBlogComments=cleanInput($pagePost['postBlogComments']);
	$editBlogEntries=cleanInput($pagePost['editBlogEntries']);
	$deleteBlogEntries=cleanInput($pagePost['deleteBlogEntries']);
	// Forums
	$createForumThreads=cleanInput($pagePost['createForumThreads']);
	$createForumPosts=cleanInput($pagePost['createForumPosts']);
	$editForumPosts=cleanInput($pagePost['editForumPosts']);
	$deleteForumPosts=cleanInput($pagePost['deleteForumPosts']);
	$manageForums=cleanInput($pagePost['manageForums']);
	
	if(getOrderOfRank($tarRank)>=getOrderOfRank($userData['rankID'])) { // Attempting to Edit Rank Greater Than Own
		addFailureNotice("Permission Denied");
	} elseif(getHighestRankID()!=$userData['rankID']) {
		$sql = "UPDATE ranks SET rankName='$rankName' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank");
		addSuccessNotice("Success: Rank Updated");
	} else {
		// Admin
		$sql = "UPDATE ranks SET rankName='$rankName', editSiteSettings='$editSiteSettings', editMemberRank='$editMemberRank', editRanks='$editRanks' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank-Admin");
		// Blog
		$sql = "UPDATE ranks SET postBlogEntries='$postBlogEntries', postBlogComments='$postBlogComments', editBlogEntries='$editBlogEntries', deleteBlogEntries='$deleteBlogEntries' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank-Blog");
		// Forums
		$sql = "UPDATE ranks SET createForumThreads='$createForumThreads', createForumPosts='$createForumPosts', editForumPosts='$editForumPosts', deleteForumPosts='$deleteForumPosts', manageForums='$manageForums' WHERE rankID='$tarRank'";
		$result = dbQuery($sql) or die ("Query failed: updateRank-Forums");
		
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