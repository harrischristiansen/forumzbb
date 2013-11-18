<?php
// Harris Christiansen
// Created 5-29-13

function viewForumThreads() {
	global $pageID;
	$threads=getForumThreadsInForum($pageID);
	$rowID=0;
	if(mysqli_num_rows($threads)==0) {
		viewFailure("No Threads Found");
		return false;
	}
	displayForumHead();
	while($thread=mysqli_fetch_array($threads)) {
		displayThreadLine($rowID,$thread['subject'],getUsername($thread['creator']),$thread['latestPost'],'0',$thread['views']);
		$rowID++;
	}
}

// General Functions

function getForumThreadsInForum($forumID) {
	$sql = "SELECT * FROM forumThreads WHERE forumID='$forumID' ORDER BY latestChange DESC";
	$result = dbQuery($sql) or die ("Query failed: getForumThreadsInForum");
	return $result;
}

function getNumForumThreadsInForum($forumID) {
	$sql = "SELECT * FROM forumThreads WHERE forumID='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: getNumForumThreadsInForum");
	return mysqli_num_rows($result);
}
?>