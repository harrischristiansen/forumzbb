<?php
// Harris Christiansen
// Created 9-14-12
// Updated 5-12-13

// Requires
require_once('Functions/forumz.references.php');
require_once('Functions/forumz.account.php');
require_once('Functions/forumz.members.php');
require_once('Functions/forumz.ranking.php');
require_once('Functions/forumz.blog.php');
require_once('Functions/forumz.settings.php');
require_once('Functions/forumz.breadcrumbs.php');
require_once('Functions/forumz.siteNotices.php');
require_once('Functions/forumz.control.php');
require_once('Functions/forumz.devTools.php');

function displayWebsite() {
	global $pageName, $pageID, $pageID2, $pagePost, $siteSettings, $userData;
	loadSettings();
	// Check if pageName is Numerical, if so set pageName to home, pageID to num.
	if(is_numeric($pageName)){
		$pageID=$pageName;
		$pageName="home";
	}
	
	addBreadcrumb(getSiteName(),"");
	if($siteSettings['siteDisabled']&&($userData['permissions']['editSiteSettings']!="true")) {
		addBreadcrumb("Site Disabled","");
		if($pageName=="login") {
			addBreadcrumb("Login","login/");
			if(isset($pagePost['loginSubmitted'])) {
				loginUser();
			}
		}
		addFailureNotice($siteSettings['disabledMessage']);
		display('viewBlank');
	} else {
	if($siteSettings['siteMotd']!="") {
		addImportantNotice($siteSettings['siteMotd']);
	}
	////// Write to take page names, view conditions, and display files from MySQL DB
	switch ($pageName) {
		case "home":
			if($siteSettings['reqLogin']&&!$userData['loggedIn']) {
				addFailureNotice("You Must Login To View This Page");
				display('viewBlank');
			} else {
				display('viewHome');
			}
			break;
		case "blog":
			addBreadcrumb("Blog Post","blog/".$pageID);
			if($pageID2=="reply"&&$pagePost['commentSubmitted']=="Reply") {
				addBlogComment();
			}
			if($siteSettings['reqLogin']&&!$userData['loggedIn']) {
				addFailureNotice("You Must Login To View This Page");
				display('viewBlank');
			} else {
				display('viewBlog');
			}
			break;
		case "register":
			addBreadcrumb("Register","register/");
			if(isset($pagePost['registerSubmitted'])) {
				registerUser();
				display('viewHome');
			} else {
				display('viewRegistration');
			}
			break;
		case "login":
			addBreadcrumb("Login","login/");
			if(isset($pagePost['loginSubmitted'])) {
				loginUser();
				display('viewHome');
			} else {
				addImportantNotice("Please Login Above");
				display('viewBlank');
			}
			break;
		case "logout":
			addBreadcrumb("Logout","logout/");
			logoutUser();
			display('viewHome');
			break;
		case "membersList":
			addBreadcrumb("Members","membersList/");
			//If Changing Users Rank
			if($pageID=="changeUserRank"&&$userData['loggedIn']&&$userData['permissions']['editMemberRank']=="true") {
				setUserRank($pageID2, $pagePost['newRank']);
			}
			display('viewMembersList');
			break;
		case "controlPanel":
			addBreadcrumb("Control Panel","controlPanel/");
			if($userData['loggedIn']) {
				if(isset($pagePost['cpFormSubmitted'])) {
					$pageNotFound=true;
					if($pageID=="changePassword") { updateAccountPassword(); $pageNotFound=false; }
					if($pageID=="editProfile") { updateAccountProfile(); $pageNotFound=false; }
					if($pageID=="changePreferences") {  $pageNotFound=false; }
					if($userData['permissions']['editSiteSettings']=="true") {
						if($pageID=="editSiteSettings") { updateSiteSettings(); $pageNotFound=false; }
						if($pageID=="addRank") { addSiteRank(); $pageNotFound=false; }
						if($pageID=="editRanks") { updateRank(); $pageNotFound=false; }
					}
					if($pageNotFound) { addFailureNotice('Error: Form Submitted To Non Existant Page'); }
				}
				display('viewControlPanel');
			} else {
				addFailureNotice("You Must Login To View This Page");
				display('viewBlank');
			}
			break;
		case "devOutput":
			writeSessionData();
			display('viewBlank');
			break;
		default:
			addBreadcrumb("Error",$pageName."/");
			addFailureNotice('Page Not Found');
			display('viewBlank');
	}}
}
function loadSettings() {
	loadMysqlSettings();
	setupSiteURLs();
}
?>