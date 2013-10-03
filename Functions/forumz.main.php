<?php
// Harris Christiansen
// Created 9-14-12

// Requires
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.account.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.blog.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.breadcrumbs.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.control.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.devTools.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forum.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forumPost.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.forumThread.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.members.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.ranking.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.references.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.security.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.settings.php');
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.siteNotices.php');

function displayWebsite() {
	global $pageName, $pageID, $pagePost, $siteSettings, $userData;
	loadSettings();
	if(!isset($userData['username'])) { // Logged Out, Anonymous Act
		setAccountToDefault();
	}
	setUserPrivileges(); // Updates Permissions On Each Page Load
	// Check if pageName is Numerical, if so set pageName to home, pageID to num.
	if(is_numeric($pageName)){
		$pageID=$pageName;
		$pageName="home";
	}
	
	addBreadcrumb(getSiteName(),"");
	if($siteSettings['siteDisabled']&&($userData['permissions']['editSiteSettings']!="true")) { // Check if site is disabled
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
	$pageDisplayed=false;
	$pageToDisplay="";
	
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
			if($pageID2!="") {
				addBreadcrumb($pageData['breadcrumbTitle'],$pageName."/".$pageID."/".$pageID2);
			} elseif($pageID!="") {
				addBreadcrumb($pageData['breadcrumbTitle'],$pageName."/".$pageID);
			} else {
				addBreadcrumb($pageData['breadcrumbTitle'],$pageName);
			}
		}
		if($pageData['pageName']!="") {
			$specPageTitle=$pageData['pageName'];
		}
		
		// Page
		if($pageData['requireLogin']=="true"&&!$userData['loggedIn']) {
			if($pageName!="login") { addFailureNotice("You Must Login To View This Page"); }
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['siteRequireLoginApplies']=="true"&&$siteSettings['reqLogin']&&!$userData['loggedIn']) {
			addFailureNotice("You Must Login To View This Site");
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['requirePermission']!=""&&$userData['permissions'][$pageData['requirePermission']]!="true") {
			addFailureNotice("You Do Not Have Permission To View This Page");
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
		} elseif($pageData['requireFormSubmitted']&&!isset($pagePost[$pageData['requireFormSubmitted']])) {
			if($pageData['falseMsg']!="") { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
		} else {
			
			$pageToDisplay=$pageData['displayFile'];
			if($pageData['trueMsg']!="") {
				addSuccessNotice($pageData['trueMsg']);
			}
			if($pageData['functionCall']!="") {
				$pageData['functionCall']();
			}
		}
	}
	
	///////////////////////////////
	
	// Display Page
	if($pageToDisplay!="") {
		display($pageToDisplay);
		$pageDisplayed=true;
	}
	elseif(!$pageDisplayed) {
		if($userData['loggedIn']||!$siteSettings['reqLogin']) {
			$pageID=1; // To Display Correct Home Page
			display('viewBlogHome');
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