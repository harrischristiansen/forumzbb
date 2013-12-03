<?php
// Harris Christiansen
// Created 5-29-13

function viewForumThread() {
	global $pageID;
	$posts = getForumPostsInThread($pageID);
	$rowID = 1;
	while($post=mysqli_fetch_array($posts)) {
		$author = getUsername($post['author']);
		$subject = $post['subject'];
		$postDate = $post['postDate'];
		$postTime = $post['postTime'];
		$post = $post['post'];
		displayForumPost($rowID, $author, $subject, $postDate, $postTime, $post);
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
	
	// Add Post
	$postID = getNumForumPosts();
	$sql = "INSERT INTO forumPosts (id, threadID, forumID, subject, post, author, postDate, postTime) VALUES ('$postID', '$threadID', '$forumID', '$threadSubject', '$threadPost', '$threadAuthor', '$threadDate', '$threadTime')";
	$result = dbQuery($sql) or die ("Query failed: createForumThread-addPost");
	
	addSuccessNotice("Reply Added");
}

?>