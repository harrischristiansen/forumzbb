<?php
// Harris Christiansen
// Created 11-02-12

////////// Home Blog View System //////////
function getBlogEntries($startID, $entriesPerPage) {
	$sql = "SELECT * FROM blogs WHERE ID>0 ORDER BY ID DESC LIMIT $startID,$entriesPerPage";
	$result = dbQuery($sql) or die ("Query failed: getBlogEntries");
	return $result;
}
function viewBlogEntries() {
	global $siteSettings, $pageID;
	if($pageID<1) { $pageID=1; }
	$blogEntriesPerPage=$siteSettings['blogEntriesPerPage'];
	$startID=$blogEntriesPerPage*($pageID-1);
	$blogEntries=getBlogEntries($startID,$blogEntriesPerPage);

	while($entry = mysqli_fetch_array($blogEntries)) {
		$blogLink=$siteSettings['siteURLShort']."blog/".$entry['ID'];
		$postDateOrTime=$entry['AuthorDate'];
		if($postDateOrTime==returnDateOfficial()) {
			$postDateOrTime=$entry['AuthorTime'];
		}
		displayHomePageBlogEntry(getMemberName($entry['Author']),$postDateOrTime,$entry['Title'],$entry['Post'],$blogLink);
	}
	if(mysqli_num_rows($blogEntries)==0) {
		viewFailure("No Entries Were Found On This Page");
	}
}

function isFirstPage() {
	global $pageID;
	if($pageID==1) {
		return true;
	} else { return false; }
}

function isLastPage() {
	global $pageID, $siteSettings;
	$lastPage = ceil(getNumPosBlogEntries()/$siteSettings['blogEntriesPerPage']);
	if($pageID=="none"||$pageID==0) {
		$pageID=1;
	}
	if($pageID>=$lastPage) {
		return true;
	} else { return false; }
}

function getNextPageLink() {
	global $pageID, $siteSettings;
	return $siteSettings['siteURLShort']."home/".($pageID+1);
}

function getPreviousPageLink() {
	global $pageID, $siteSettings;
	$lastPage = ceil(getNumPosBlogEntries()/$siteSettings['blogEntriesPerPage']);
	// Setup to return to latest page upon clicking newer entries button
	if($pageID>$lastPage) {
		$pageID=$lastPage+1;
	}
	return $siteSettings['siteURLShort']."home/".($pageID-1);
}


////////// Select Blog View System //////////
function getBlogEntry($entryID) {
	$sql = "SELECT * FROM blogs WHERE ID='$entryID'";
	$result = dbQuery($sql) or die ("Query failed: getBlogEntry");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray;
}
function viewBlogPageBlogEntry() {
	global $pageID, $userData, $siteSettings;
	$blogEntry = getBlogEntry($pageID);
	$canEdit=$userData['permissions']['editBlogEntries']; // User Has Admin Access
	$canDelete=$userData['permissions']['deleteBlogEntries']; // User Has Admin Access
	if($userData['actID']==$blogEntry['Author']) { $canEdit=true;$canDelete=true; } // User Posted Entry
	if($canEdit) { $editEntryLink=$siteSettings['siteURLShort']."editBlog/".($pageID); }
	if($canDelete) { $deleteEntryLink=$siteSettings['siteURLShort']."deleteBlog/".($pageID); }
	displayBlogEntry(getMemberName($blogEntry['Author']),$blogEntry['AuthorDate'],$blogEntry['AuthorTime'],$blogEntry['Title'],$blogEntry['Post'],$editEntryLink,$deleteEntryLink);
}
function checkBlogEntryExists() { // Used in viewBlog.php
	global $pageID;
	$sql = "SELECT * FROM blogs WHERE ID='$pageID'";
	$result = dbQuery($sql) or die ("Query failed: checkBlogEntryExists");
	if(mysqli_num_rows($result)==0) {
		addFailureNotice("ERROR: No Entry Was Found On This Page");
		return false;
	}
	return true;
}


////////// Blog Comment View System //////////

function getBlogComments($blogID) {
	$sql = "SELECT * FROM blogComments WHERE blogID='$blogID' ORDER BY idNum";
	$result = dbQuery($sql) or die ("Query failed: getBlogComments");
	return $result;
}

function viewBlogComments() {
	global $pageID;
	$blogComments=getBlogComments($pageID);

	while($comment = mysqli_fetch_array($blogComments)) {
		displayBlogComment(getMemberName($comment['posterID']),$comment['date'],$comment['time'],$comment['comment']);
	}
}

//////////// New Blog Entry System //////////
function addBlogEntry() {
	global $userData, $pagePost, $pageID, $con;
	$newEntryTitle=cleanInput($pagePost['blogEntryTitle']);
	$newEntryText=formatPost($pagePost['blogEntryText']);
	if($userData['permissions']['postBlogEntries']!="true") {
		addFailureNotice("Permission Denied");
	} elseif($newEntryTitle==""||$newEntryText=="") {
		addFailureNotice("Please Type An Entry Before Submitting");
	} else {
		$blogID=getNumBlogEntries()+1;
		$pageID=$blogID; // To Display Blog Once Added
		$author=$userData['actID'];
		$date=returnDateOfficial();
		$time=returnTime();
		$sql = "INSERT INTO blogs (ID, Title, Author, AuthorDate, AuthorTime, Post) VALUES ('$blogID','$newEntryTitle','$author','$date', '$time', '$newEntryText')";
		$result = dbQuery($sql) or die ("Query failed: addBlogEntry");
		addSuccessNotice("Blog Entry Created");
	}
}
function getNewBlogPageLink() {
	global $siteSettings;
	return $siteSettings['siteURLShort']."composeEntry/";
}

////////// Blog Comment Post System //////////
function addBlogComment() {
	global $pageID, $userData, $pagePost, $con;
	if($userData['permissions']['postBlogComments']=="true") {
		$commentID=numBlogComments();
		$postClean=formatPost($pagePost['blogCommentText']);
		$date=returnDateOfficial();
		$time=returnTime();
		$userID=$userData['actID'];
		$sql = "INSERT INTO blogComments (idNum, blogID, posterID, date, time, comment) VALUES ('$commentID','$pageID','$userID','$date', '$time', '$postClean')";
		$result = dbQuery($sql) or die ("Query failed: addBlogComment");
		addSuccessNotice("Comment Added");
	} else {
		addFailureNotice("Permission Denied To Add Comment");
	}
}
function canPostBlogComments() {
	global $userData;
	if($userData['permissions']['postBlogComments']=="true") {
		return true;
	}
	return false;
}

////////// Edit Blog System //////////
function editBlogPost() {
	global $pageID, $userData, $pagePost, $con;
	if($userData['permissions']['editBlogEntries']=="true"||$userData['actID']==getBlogAuthorID($pageID)) {
		$newBlogEntry=formatPost($pagePost['blogEntryText']);
		$updateAuthor=$userData['actID'];
		$updateDate=returnDateOfficial();
		$sql = "UPDATE blogs SET Post='$newBlogEntry',updateAuthor='$updateAuthor',updateDate='$updateDate' WHERE ID='$pageID'";
		$result = dbQuery($sql) or die ("Query failed: editBlogPost");
		addSuccessNotice("Blog Entry Updated");
	} else {
		addFailureNotice("Permission Denied");
	}
}
function getBlogComposeField() {
	global $pageID, $siteSettings, $userData;
	if($pageID!="") { // Updating Entry
		if($userData['permissions']['editBlogEntries']=="true"||$userData['actID']==getBlogAuthorID($pageID)) {
			$formLink=$siteSettings['siteURLShort'].'editBlog/'.$pageID;
			$blogEntry=getBlogEntry($pageID);
			$currentEntry=reverseFormatPost($blogEntry['Post']);
			displayBlogComposeField($formLink, true, $currentEntry);
		}
	} else { // Creating New Entry
		$formLink=$siteSettings['siteURLShort'].'composeEntry/';
		displayBlogComposeField($formLink, false, "");
	}
}

////////// Delete Blog System /////////
function deleteBlogPost() {
	global $pageID, $userData;
	if($userData['permissions']['deleteBlogEntries']=="true"||$userData['actID']==getBlogAuthorID($pageID)) {
		$newBlogID=-$pageID;
		$sql = "UPDATE blogs SET ID='$newBlogID' WHERE ID='$pageID'";
		$result = dbQuery($sql) or die ("Query failed: deleteBlogPost");
		addSuccessNotice("Blog Entry Deleted");
		$pageID=1; // For Displaying Website Home
	} else {
		addFailureNotice("Permission Denied");
	}
}

function getBlogAuthorID($blogID) {
	$sql = "SELECT * FROM blogs WHERE ID='$blogID'";
	$result = dbQuery($sql) or die ("Query failed: getBlogAuthorID");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['Author'];
}
?>