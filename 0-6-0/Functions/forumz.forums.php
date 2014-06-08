<?php
// Harris Christiansen
// Created 5-29-13

function viewForumHome() {
	global $siteSettings;
	$categories=getForumCategories();
	while($category = mysqli_fetch_array($categories)) {
		displayForumCatHead($category['title']);
		$catForums = getForumsInCat($category['id']);
		$rowID=0;
		while($forum = mysqli_fetch_array($catForums)) {
			$latestPost=unserialize(base64_decode($forum['latestPost']));
			$latestPostDateTime = split(' ',$latestPost['date']);
			$latestPostDate = returnDateTimeView($latestPostDateTime[0],$latestPostDateTime[1]);
			$forumLink=$siteSettings['siteURLShort'].'forum/'.$forum['id'];
			$latestPostLink=$siteSettings['siteURLShort'].'thread/'.$latestPost['threadID'];
			displayForumLine($rowID, $forum['title'], $forum['desc'], getNumForumThreadsInForum($forum['id']), getNumForumPostsInForum($forum['id']), $latestPost['title'], getUsername($latestPost['author']), $latestPostDate, $forumLink, $latestPostLink);
			$rowID++;
		}
	}
}


// General Functions
function getForumCategories() {
	$sql = "SELECT * FROM forumCats ORDER BY orderID";
	$result = dbQuery($sql) or die ("Query failed: getForumCategories");
	return $result;
}

function getForumsInCat($catID) {
	$sql = "SELECT * FROM forums WHERE catID='$catID' ORDER BY title";
	$result = dbQuery($sql) or die ("Query failed: getForumsInCat");
	return $result;
}

function getForumByID($forumID) {
	$sql = "SELECT * FROM forums WHERE id='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: getForumByID");
	return mysqli_fetch_array($result);
}

function getNumForums() {
	$sql = "SELECT * FROM forums";
	$result = dbQuery($sql) or die ("Query failed: getNumForums");
	return mysqli_num_rows($result);
}

function getForumTitle($forumID) {
	$sql = "SELECT * FROM forums WHERE id='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: getForumTitle");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['title'];
}
?>