<?
// Harris Christiansen
// Created 2013-11-17

function getSiteStats() {
	viewHTML('Total Members: '.getSiteNumMembers().'<br>');
	viewHTML('Total Blog Posts: '.getNumPosBlogEntries().'<br>');
	viewHTML('Total Blog Comments: '.numBlogComments().'<br>');
	viewHTML('Total Forum Threads: '.getNumForumThreads().'<br>');
}
function getSiteNumMembers() {
	$sql = "SELECT * FROM accounts WHERE actID<>'Anonymous'";
	$result = dbQuery($sql) or die ("Query failed: getSiteNumMembers");
	return mysqli_num_rows($result);
}
function getNumPosBlogEntries() {
	$sql = "SELECT * FROM blogs WHERE ID>=0";
	$result = dbQuery($sql) or die ("Query failed: getNumPosBlogEntries");
	return mysqli_num_rows($result);
}
function getNumBlogEntries() {
	$sql = "SELECT * FROM blogs";
	$result = dbQuery($sql) or die ("Query failed: getNumBlogEntries");
	return mysqli_num_rows($result);
}
function numBlogComments() {
	$sql = "SELECT * FROM blogComments";
	$result = dbQuery($sql) or die ("Query failed: numBlogComments");
	return mysqli_num_rows($result);
}
function getNumForumThreads() {
	$sql = "SELECT * FROM forumThreads";
	$result = dbQuery($sql) or die ("Query failed: getNumForumThreads");
	return mysqli_num_rows($result);
}
?>