<?php
// Harris Christiansen
// Created 9-14-12

// Requires
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.account.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.bbCode.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.blog.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.breadcrumbs.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.control.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.devTools.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.email.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forums.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forumPosts.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forumThreads.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.members.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.permissions.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.ranking.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.references_account.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.references_display.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.references_site.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.security.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.settings.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.siteNotices.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.stats.php');

function displayWebsite() {
	global $pageName, $pageID, $pagePost, $siteSettings, $userData;
	loadSettings();
	if(!isset($userData['username'])) { // Logged Out, Anonymous Act
		if(ipFlaggedAsSpam(returnRemoteIP())) {
			addFailureNotice("We are sorry, but your IP is flagged as spam. You may not visit the website");
			display('viewBlank');
			return false;
		}
		setAccountToDefault();
	}
	setUserPrivileges(); // Updates Permissions On Each Page Load
	// Check if pageName is Numerical, if so set pageName to home, pageID to num.
	if(is_numeric($pageName)){
		$pageID=$pageName;
		$pageName="home";
	}
	
	addBreadcrumb(getSiteName(),"");
	if($siteSettings['siteDisabled']&&!userCan('editSiteSettings')) { // Check if site is disabled
		addBreadcrumb("Site Disabled","");
		if($pageName=="login") {
			addBreadcrumb("Login","login/");
			if(isset($pagePost['loginSubmitted'])) {
				loginUser();
			}
		}
		addFailureNotice($siteSettings['disabledMessage']);
		display('viewBlank');
	} elseif(userIsBanned()) { // Check if user is banned
		display('viewBlank');
	} else {
		if($siteSettings['siteMotd']!="") {
			addImportantNotice($siteSettings['siteMotd']);
		}
		// Page Loader
		loadPage();
	}
}
function loadPage() {
	global $pageName, $pageID, $pageID2, $pagePost, $siteSettings, $userData, $specPageTitle;
	$pageToDisplay="";$themeReq="";
	
	///////////////////////////////
	
	// Load Page
	$sql = "SELECT * FROM pages WHERE pageURL='$pageName'";
	$result = dbQuery($sql) or die ("Query failed: loadPageByName");
	$numPages=mysqli_num_rows($result);
	if($numPages>=2) {
		if($pageID!="") {
			$sql = "SELECT * FROM pages WHERE pageURL='$pageName' AND (idDependant='$pageID')";
		}
		if($pageID2!="") {
			$sql = "SELECT * FROM pages WHERE pageURL='$pageName' AND (idDependant='$pageID2')";
		}
		if($pageID!=""&&$pageID2!="") {
			$sql = "SELECT * FROM pages WHERE pageURL='$pageName' AND (idDependant='$pageID' OR idDependant='$pageID2')";
		}
		$result = dbQuery($sql) or die ("Query failed: loadPageByNameAndID");
		$numPages=mysqli_num_rows($result);
		if($numPages==0) {
			$sql = "SELECT * FROM pages WHERE pageURL='$pageName' AND (idDependant='')";
			$result = dbQuery($sql) or die ("Query failed: loadPageByNameAndBlankID");
			$numPages=mysqli_num_rows($result);
		}
	}
	if($numPages==0) {
		addFailureNotice("Page Not Found");
		$specPageTitle="Page Not Found";
	} else {
		$pageData=mysqli_fetch_array($result);
		// Breadcrumbs
		if($pageData['breadcrumbTitle']!="") {
			$breadcrumbs = explode("->",$pageData['breadcrumbTitle']);
			if(count($breadcrumbs)==3) {
				addBreadcrumb($breadcrumbs[0],$pageName);
				addBreadcrumb($breadcrumbs[1],$pageName."/".$pageID);
				addBreadcrumb($breadcrumbs[2],$pageName."/".$pageID."/".$pageID2);
			}
			elseif(count($breadcrumbs)==2) {
				addBreadcrumb($breadcrumbs[0],$pageName);
				if($pageID2!="") {
					addBreadcrumb($breadcrumbs[1],$pageName."/".$pageID."/".$pageID2);
				} elseif($pageID!="") {
					addBreadcrumb($breadcrumbs[1],$pageName."/".$pageID);
				}
			}
			else {
				if($pageID2!="") {
					addBreadcrumb($breadcrumbs[0],$pageName."/".$pageID."/".$pageID2);
				} elseif($pageID!="") {
					addBreadcrumb($breadcrumbs[0],$pageName."/".$pageID);
				} else {
					addBreadcrumb($pageData['breadcrumbTitle'],$pageName);
				}
			}
		}
		
		// Page
		if($pageData['requireLogin']=="true"&&!$userData['loggedIn']) {
			if($pageName!="login") { addFailureNotice("You Must Login To View This Page"); }
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['siteRequireLoginApplies']=="true"&&$siteSettings['reqLogin']&&!$userData['loggedIn']) {
			addFailureNotice("You Must Login To View This Site");
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['requirePermission']!=""&&!userCan($pageData['requirePermission'])) {
			addFailureNotice("You Do Not Have Permission To View This Page");
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['requireFormSubmitted']&&!isset($pagePost[$pageData['requireFormSubmitted']])) {
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
			$themeReq = $pageData['requireTheme'];
		} else {
			$pageToDisplay=$pageData['displayFile'];
			$themeReq = $pageData['requireTheme'];
			if($pageData['trueMsg']!="") {
				addSuccessNotice($pageData['trueMsg']);
			}
			if($pageData['functionCall']!="") {
				$pageData['functionCall']();
			}
		}
		
		// Page Name
		if($pageData['pageName']!="") {
			$pageTitle = $pageData['pageName'];
			$pageTitle = str_replace("threadTitle",getForumTitle(getForumIDOfThread($pageID)).' - '.getThreadTitle($pageID),$pageTitle);
			$pageTitle = str_replace("forumTitle",getForumTitle($pageID),$pageTitle);
			$specPageTitle=$pageTitle;
		}
	}
	
	///////////////////////////////
	
	// Display Page
	if($pageToDisplay!="") {
		if($themeReq!="") {
			displayWithTheme($pageToDisplay,$themeReq);
		} else {
			display($pageToDisplay);
		}
	}
	else {
		if(isLoggedIn()||!$siteSettings['reqLogin']) {
			$pageID=1; // To Display Correct Home Page
			display('viewHome');
		} else {
			display('viewBlank');
		}
	}
}
function loadSettings() {
	// Site Settings Loaded in index.php
	setupSiteURLs();
}
?>