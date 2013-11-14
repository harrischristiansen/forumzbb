<?php
// Harris Christiansen
// Created 5-29-13

function viewForumThreads() {
	global $pageID;
	$threads=getForumThreadsInForum($pageID);
	$rowID=0;
	displayForumHead();
	while($thread=mysqli_fetch_array($threads)) {
		displayThreadLine($rowID,$subject,$startBy,$latestBy,$replies,$views);
		$rowID++;
	}
}

// General Functions

function getForumThreadsInForum($forumID) {
	$sql = "SELECT * FROM forumsThreads WHERE forumID='$forumID' ORDER BY orderID DESC";
	$result = dbQuery($sql) or die ("Query failed: getForumThreadsInForum");
	return $result;
}

function getNumForumThreads() {
	$sql = "SELECT * FROM forumThreads";
	$result = dbQuery($sql) or die ("Query failed: getNumForumThreads");
	return mysqli_num_rows($result);
}

function getNumForumThreadsInForum($forumID) {
	$sql = "SELECT * FROM forumThreads WHERE forumID='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: getNumForumThreadsInForum");
	return mysqli_num_rows($result);
}
?>