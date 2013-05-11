<?php
// Harris Christiansen
// Created 11-02-12
// Updated 11-09-12

// Blog Client Side View System


function getBlogEntry($entryID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs WHERE ID='$entryID'";
	$result = mysqli_query($con, $sql) or die ("Query failed: getBlogEntry");
	$sqlQueries++;
	$resultArray = mysqli_fetch_array($result);
	return $resultArray;
}

function getBlogEntries($startID, $endID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs WHERE ID>='$startID' AND ID<'$endID' ORDER BY ID DESC";
	$result = mysqli_query($con, $sql) or die ("Query failed: getBlogEntries");
	$sqlQueries++;
	return $result;
}

function getBlogEntry($blogID) {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs WHERE ID='$blogID'";
	$result = mysqli_query($con, $sql) or die ("Query failed: getBlogEntry");
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
	
	$rowID=0;
	while($entry = mysqli_fetch_array($blogEntries)) {
		$blogLink=$siteSettings['siteURLShort']."blog/".$entry['ID'];
		displayHomePageBlogEntry(getMemberName($entry['Author']),$entry['AuthorDate'],$entry['Title'],$entry['Post'],$blogLink);
		$rowID++;
	}
	if(mysqli_num_rows($blogEntries)==0) {
		viewFailure("No Entries Were Found On This Page");
	}
}

function getNumBlogEntries() {
	global $con, $sqlQueries;
	$sql = "SELECT * FROM blogs";
	$result = mysqli_query($con, $sql) or die ("Query failed: getNumBlogEntries");
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

function viewBlogPage() {
	global $pageID;
	$blogEntry = getBlogEntry($pageID);
	displayBlogEntry(getMemberName($entry['Author']),$entry['AuthorDate'],$entry['AuthorTime'],$entry['Title'],$entry['Post']);
}
?>