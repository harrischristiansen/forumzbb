<?php
// Harris Christiansen
// Created 5-29-13

function viewForumThread() {
	global $pageID, $siteSettings;
	$posts = getForumPostsInThread($pageID);
	$rowID = 1;
	while($post=mysqli_fetch_array($posts)) {
		$author = getUsername($post['author']);
		$subject = $post['subject'];
		$postDate = $post['postDate'];
		$postTime = $post['postTime'];
		$postText = $post['post'];
		$viewEdit = userCan('editForumPosts');
		$viewDelete = userCan('deleteForumPosts');
		if($post['author']==returnUserID()) { $viewEdit = true; $viewDelete = true; }
		$editLink = $siteSettings['siteURLShort']."editForumPost/".$post['id'];
		$deleteLink  = $siteSettings['siteURLShort']."deleteForumPost/".$post['id'];
		$editText = reverseFormatPost($postText);
		displayForumPost($rowID, $author, $subject, $postDate, $postTime, $postText, $viewEdit, $viewDelete, $editLink, $deleteLink, $editText);
		$rowID++;
	}
}

// General Functions

function getForumPostsInThread($threadID) {
	$sql = "SELECT * FROM forumPosts WHERE threadID='$threadID' ORDER BY postDate, postTime";
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

// Update View Count

function updateThreadViewCount() {
	global $pageID;
	$threadID = $pageID;
	$sql = "UPDATE forumThreads SET views=views+1 WHERE id='$threadID'";
	$result = dbQuery($sql) or die ("Query failed: updateThreadViewCount");
}

// Add Comment

function addForumPost() {
	global $pagePost, $pageID;
	$threadID = $pageID;
	$threadPost = formatPost($pagePost['threadPost']);
	$forumID = getForumIDOfThread($threadID);
	$threadSubject = "RE: ".getThreadTitle($threadID);
	$threadAuthor = returnUserID();
	$threadDate = returnDateOfficial();
	$threadTime = returnTime();
	$latestChange = $threadDate.' '.$threadTime;
	
	// Update Forum Latest Thread
	$latestPostArray['title']=$threadSubject;
	$latestPostArray['author']=$threadAuthor;
	$latestPostArray['date']=$latestChange;
	$latestPostArray['threadID']=$threadID;
	$latestPost = serialize($latestPostArray);
	$sql = "UPDATE forums SET latestPost='$latestPost' WHERE id='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: addForumPost-updateForumLatestThread");
	
	// Update Thread Latest Change
	$sql = "UPDATE forumThreads SET latestChange='$latestChange' WHERE id='$threadID'";
	$result = dbQuery($sql) or die ("Query failed: addForumPost-updateThreadLatestChange");
	
	// Add Post
	$postID = getNumForumPosts();
	$sql = "INSERT INTO forumPosts (id, threadID, forumID, subject, post, author, postDate, postTime) VALUES ('$postID', '$threadID', '$forumID', '$threadSubject', '$threadPost', '$threadAuthor', '$threadDate', '$threadTime')";
	$result = dbQuery($sql) or die ("Query failed: addForumPost-addPost");
	
	addSuccessNotice("Reply Added");
}

// Edit Forum Post
function editForumPost() {
	global $pageID, $pagePost;
	if($pageID=="") {
		addFailureNotice("Invalid Action");
		return false;
	}
	if(userCan('editForumPosts')||returnUserID()==getForumPostAuthorID($pageID)) {
		$newForumPost=formatPost($pagePost['forumPost']);
		$sql = "UPDATE forumPosts SET post='$newForumPost' WHERE id='$pageID'";
		$result = dbQuery($sql) or die ("Query failed: editForumPost");
		addSuccessNotice("Post Updated");
	} else {
		addFailureNotice("Permission Denied");
	}
	
	// Set pageID to threadID
	$pageID = getThreadIDOfPost($pageID);
}

// Delete Forum Post
function deleteForumPost() {
	global $pageID;
	if($pageID=="") {
		addFailureNotice("Invalid Action");
		return false;
	}
	if(userCan('deleteForumPosts')||returnUserID()==getForumPostAuthorID($pageID)) {
		// If first post, delete thread - require permission not just ownership
		$newPostID = 0-$pageID;
		$sql = "UPDATE forumPosts SET id='$newPostID' WHERE id='$pageID'";
		$result = dbQuery($sql) or die ("Query failed: deleteForumPost");
		addSuccessNotice("Post Deleted");
	} else {
		addFailureNotice("Permission Denied");
	}
	
	// Set pageID to threadID
	$pageID = getThreadIDOfPost($newPostID);
}

// Lookup Functions
function getForumPostAuthorID($postID) {
	$sql = "SELECT * FROM forumPosts WHERE id='$postID'";
	$result = dbQuery($sql) or die ("Query failed: getForumPostAuthorID");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['author'];
}

function getThreadIDOfPost($postID) {
	$sql = "SELECT * FROM forumPosts WHERE id='$postID'";
	$result = dbQuery($sql) or die ("Query failed: getForumPostAuthorID");
	$resultArray = mysqli_fetch_array($result);
	return $resultArray['threadID'];
}

?>