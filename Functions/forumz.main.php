<?php
// Harris Christiansen
// Created 9-14-12
// Updated 5-15-13

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
require_once('Functions/forumz.databaseTools.php');

function displayWebsite() {
	global $pageName, $pageID, $pagePost, $siteSettings, $userData;
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
		// Page Loader
		loadPage();
	}
}
function loadPage() {
	global $pageName, $pageID, $pageID2, $pagePost, $siteSettings, $userData, $con, $sql;
	$pageDisplayed=false;
	$pageToDisplay="";
	
	///////////////////////////////
	
	// Load Page
	$sql = "SELECT * FROM pages WHERE pageURL='$pageName'";
	$result = dbQuery($con, $sql) or die ("Query failed: loadPageByName");
	$sqlQueries++;
	$numPages=mysqli_num_rows($result);
	if($numPages>=2) {
		$sql = "SELECT * FROM pages WHERE pageURL='$pageName' AND (idDependant='$pageID' OR idDependant='$pageID2')";
		$result = dbQuery($con, $sql) or die ("Query failed: loadPageByNameAndID");
		$sqlQueries++;
		$numPages=mysqli_num_rows($result);
	}
	if($numPages==0) {
		addFailureNotice("Page Not Found");
	} else {
		$pageData=mysqli_fetch_array($result);
		if($pageData['requireLogin']=="true"&&!$userData['loggedIn']) {
			if($pageName!="login") { addFailureNotice("You Must Login To View This Page"); }
			if(isset($pageData['falseMsg'])) { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
		} elseif($pageData['siteRequireLoginApplies']=="true"&&$siteSettings['reqLogin']&&!$userData['loggedIn']) {
			addFailureNotice("You Must Login To View This Page");
			if(isset($pageData['falseMsg'])) { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
		} elseif($pageData['requireAdmin']&&$userData['permissions']['adminStatus']!="true") {
			addFailureNotice("You Do Not Have Permission To View This Page");
			if(isset($pageData['falseMsg'])) { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
		} elseif($pageData['requireFormSubmitted']&&!isset($pagePost[$pageData['requireFormSubmitted']])) {
			addFailureNotice("Error: Required Form Not Submitted");
			if(isset($pageData['falseMsg'])) { addFailureNotice($pageData['falseMsg']); }
			$pageToDisplay=$pageData['falseDisplayFile'];
		} else {
			if($pageData['breadcrumbTitle']!="") {
				if(isset($pageID2)) {
					addBreadcrumb($pageData['breadcrumbTitle'],$pageURL."/".$pageID."/".$pageID2);
				} elseif(isset($pageID)) {
					addBreadcrumb($pageData['breadcrumbTitle'],$pageURL."/".$pageID);
				} else {
					addBreadcrumb($pageData['breadcrumbTitle'],$pageURL);
				}
			}
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
		if($userData['loggedIn']) {
			display('viewHome');
		} else {
			display('viewBlank');
		}
	}
}
function loadSettings() {
	loadMysqlSettings();
	setupSiteURLs();
}
?>