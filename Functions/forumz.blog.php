<?php
// Harris Christiansen
// Created 11-02-12
// Updated 5-16-13

// Blog View System


function getBlogEntry($entryID) {
	$sql = "SELECT * FROM blogs WHERE ID='$entryID'";
	$result = dbQuery($sql) or die ("Query failed: getBlogEntry");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray;
}

function getBlogEntries($startID, $endID) {
	$sql = "SELECT * FROM blogs WHERE ID>='$startID' AND ID<'$endID' ORDER BY ID DESC";
	$result = dbQuery($sql) or die ("Query failed: getBlogEntries");
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
	$sql = "SELECT * FROM blogs";
	$result = dbQuery($sql) or die ("Query failed: getNumBlogEntries");
	return mysqli_num_rows($result);
}

function isFirstPage() {
	global $pageID;
	if($pageID=="none"||$pageID==0||$pageID==1) {
		return true;
	} else { return false; }
}

function isLastPage() {
	global $pageID, $siteSettings;
	$lastPage = ceil(getNumBlogEntries()/$siteSettings['blogEntriesPerPage']);
	if($pageID>=$lastPage) {
		return true;
	} else { return false; }
}

function getNextPageLink() {
	global $pageID, $siteSettings;
	if($pageID<=1) {
		$pageID=1;
	}
	return $siteSettings['siteURLShort']."home/".($pageID+1);
}

function getPreviousPageLink() {
	global $pageID, $siteSettings;
	$lastPage = ceil(getNumBlogEntries()/$siteSettings['blogEntriesPerPage']);
	// Setup to return to latest page upon clicking newer entries button
	if($pageID>$lastPage) {
		$pageID=$lastPage+1;
	}
	return $siteSettings['siteURLShort']."home/".($pageID-1);
}


// Blog Comment View System

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

function numBlogComments() {
	$sql = "SELECT * FROM blogComments";
	$result = dbQuery($sql) or die ("Query failed: numBlogComments");
	return mysqli_num_rows($result);
}

// New Blog Entry System
function addBlogEntry() {
	global $userData, $pagePost, $pageID, $con;
	$newEntryTitle=mysqli_real_escape_string($con, $pagePost['blogEntryTitle']);
	$newEntryText=mysqli_real_escape_string($con, $pagePost['blogEntryText']);
	if($userData['permissions']['postBlogEntries']!="true") {
		addFailureNotice("Permission Denied");
	} elseif($newEntryTitle==""||$newEntryText=="") {
		addFailureNotice("Please Type An Entry Before Submitting");
	} else {
		$blogID=getNumBlogEntries();
		$pageID=$blogID; // To Display Blog Once Added
		$author=$userData['actID'];
		$date=returnDateShort();
		$time=returnTime();
		$sql = "INSERT INTO blogs (ID, Title, Author, AuthorDate, AuthorTime, Post) VALUES ('$blogID','$newEntryTitle','$author','$date', '$time', '$newEntryText')";
		$result = dbQuery($sql) or die ("Query failed: addBlogEntry");
		addSuccessNotice("Blog Entry Created");
	}
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
	return $siteSettings['siteURLShort']."composeEntry/";
}

// Blog Comment Post System
function addBlogComment() {
	global $pageID, $userData, $pagePost, $con;
	if($userData['permissions']['postBlogComments']=="true") {
		$commentID=numBlogComments();
		$postClean=mysqli_real_escape_string($con, $pagePost['blogCommentText']);
		$date=returnDateShort();
		$time=returnTime();
		$userID=$userData['actID'];
		$sql = "INSERT INTO blogComments (idNum, blogID, posterID, date, time, comment) VALUES ('$commentID','$pageID','$userID','$date', '$time', '$postClean')";
		$result = dbQuery($sql) or die ("Query failed: addBlogComment");
		addSuccessNotice("Comment Added");
	} else {
		addFailureNotice("Permission Denied To Add Comment");
	}
}

?>