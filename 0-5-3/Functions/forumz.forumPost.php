<?php
// Harris Christiansen
// Created 5-29-13
// Updated 5-29-13


// General Functions

function getForumPostsInThread($threadID) {
	$sql = "SELECT * FROM forumsPosts WHERE threadID='$threadID' ORDER BY id DESC";
	$result = dbQuery($sql) or die ("Query failed: getForumPostsInThread");
	return $result;
}

function getNumForumPostsInThread($threadID) {
	$sql = "SELECT * FROM forumPosts WHERE threadID='$threadID'";
	$result = dbQuery($sql) or die ("Query failed: getNumForumPostsInThread");
	return mysqli_num_rows($result);
}

function getNumForumPostsInForum($forumID) {
	$sql = "SELECT * FROM forumPosts WHERE forumID='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: getNumForumPostsInForum");
	return mysqli_num_rows($result);
}
?>