<?php
// Harris Christiansen
// Created 11-02-12
// Updated 5-16-13

// Blog View System


function getBlogEntry($entryID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs WHERE ID='$entryID'";
	$result = dbQuery($con, $sql) or die ("Query failed: getBlogEntry");
	$sqlQueries++;
	$resultArray = mysqli_fetch_array($result);
	return $resultArray;
}

function getBlogEntries($startID, $endID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs WHERE ID>='$startID' AND ID<'$endID' ORDER BY ID DESC";
	$result = dbQuery($con, $sql) or die ("Query failed: getBlogEntries");
	$sqlQueries++;
	return $result;
}

function viewBlogEntries() {
	global $siteSettings, $pageID;
	$blogEntriesPerPage=$siteSettings['blogEntriesPerPage'];
	$startID=getNumBlogEntries()-$blogEntriesPerPage;
	$endID=getNumBlogEntries();
	if($pageID!="none"&&$pageID>=2) {
		$numToSubtract=($pageID-1)*$blogEntriesPerPage;
		$startID-=$numToSubtract;
		$endID-=$numToSubtract;
	}
	
	
	$blogEntries=getBlogEntries($startID,$endID);
	
	while($entry = mysqli_fetch_array($blogEntries)) {
		$blogLink=$siteSettings['siteURLShort']."blog/".$entry['ID'];
		displayHomePageBlogEntry(getMemberName($entry['Author']),$entry['AuthorDate'],$entry['Title'],$entry['Post'],$blogLink);
	}
	if(mysqli_num_rows($blogEntries)==0) {
		viewFailure("No Entries Were Found On This Page");
	}
}

function viewBlogPageBlogEntry() {
	global $pageID;
	$blogEntry = getBlogEntry($pageID);
	displayBlogEntry(getMemberName($blogEntry['Author']),$blogEntry['AuthorDate'],$blogEntry['AuthorTime'],$blogEntry['Title'],$blogEntry['Post']);
}


function getNumBlogEntries() {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs";
	$result = dbQuery($con, $sql) or die ("Query failed: getNumBlogEntries");
	$sqlQueries++;
	return mysqli_num_rows($result);
}

function isFirstPage() {
	global $pageID;
	if($pageID=="none"||$pageID==0||$pageID==1) {
		return true;
	} else { return false; }
}

function isLastPage() {
	global $pageID,$siteSettings;
	$lastPage = ceil(getNumBlogEntries()/$siteSettings['blogEntriesPerPage']);
	if($pageID>=$lastPage) {
		return true;
	} else { return false; }
}

function getNextPageLink() {
	global $pageID,$siteSettings;
	if($pageID<=1) {
		$pageID=1;
	}
	return $siteSettings['siteURLShort']."home/".($pageID+1);
}

function getPreviousPageLink() {
	global $pageID,$siteSettings;
	$lastPage = ceil(getNumBlogEntries()/$siteSettings['blogEntriesPerPage']);
	if($pageID>$lastPage) {
		$pageID=$lastPage+1;
	}
	return $siteSettings['siteURLShort']."home/".($pageID-1);
}


// Blog Comment View System

function getBlogComments($blogID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogComments WHERE blogID='$blogID' ORDER BY idNum";
	$result = dbQuery($con, $sql) or die ("Query failed: getBlogComments");
	$sqlQueries++;
	return $result;
}

function viewBlogComments() {
	global $pageID;
	$blogComments=getBlogComments($pageID);

	while($comment = mysqli_fetch_array($blogComments)) {
		displayBlogComment(getMemberName($comment['posterID']),$comment['date'],$comment['time'],$comment['comment']);
	}
}

function numBlogComments() {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogComments";
	$result = dbQuery($con, $sql) or die ("Query failed: numBlogComments");
	$sqlQueries++;
	return mysqli_num_rows($result);
}

// New Blog Entry System
function addBlogEntry() {
	
}
function canMakeBlogPosts() {
	global $userData;
	if($userData['permissions']['postBlogEntries']=="true") {
		return true;
	}
	return false;
}
function getNewBlogPageLink() {
	global $siteSettings;
	return $siteSettings['siteURLShort']."newBlogEntry/";
}

// Blog Comment Post System
function addBlogComment() {
	global $con, $sqlQueries, $pageID, $userData, $pagePost;
	if($userData['permissions']['postBlogComments']=="true") {
		$commentID=numBlogComments();
		$postClean=mysqli_real_escape_string($con, $pagePost['blogCommentText']);
		$date=returnDateShort();
		$time=returnTime();
		$userID=$userData['actID'];
		$sql = "INSERT INTO blogComments (idNum, blogID, posterID, date, time, comment) VALUES ('$commentID','$pageID','$userID','$date', '$time', '$postClean')";
		$result = dbQuery($con, $sql) or die ("Query failed: addBlogComment");
		$sqlQueries++;
		addSuccessNotice("Comment Added");
	} else {
		addFailureNotice("Permission Denied To Add Comment");
	}
}

?>