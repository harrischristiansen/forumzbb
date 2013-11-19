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
		$latestPost = unserialize($thread['latestPost']);
		$latestBy = 
		displayThreadLine($rowID,$thread['subject'],getUsername($thread['creator']),getUsername($latestPost['author']),$latestPost['date'],'0',$thread['views']);
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

// New Forum Thread

function createForumThread() {
	global $pageID, $pagePost, $userData;
	$forumID = $pageID;
	$threadSubject = cleanInput($pagePost['threadSubject']);
	$threadPost = formatPost($pagePost['threadPost']);
	$threadDate = returnDateOfficial();
	$threadTime = returnTime();
	$latestChange = $threadDate.' '.$threadTime;
	$threadID = getNumForumThreads();
	$threadAuthor = $userData['actID'];
	$latestPostArray['title']=$threadSubject;
	$latestPostArray['author']=$threadAuthor;
	$latestPostArray['date']=$latestChange;
	$latestPostArray['threadID']=$threadID;
	$latestPost = serialize($latestPostArray);
	$views = 0;
	
	// Update Forum Latest Thread
	$sql = "UPDATE forums SET latestPost='$latestPost' WHERE id='$forumID'";
	$result = dbQuery($sql) or die ("Query failed: createForumThread-updateForumLatestThread");
	
	// Create Thread
	$sql = "INSERT INTO forumThreads (id, latestChange, forumID, subject, creator, latestPost, views) VALUES ('$threadID', '$latestChange', '$forumID', '$threadSubject', '$threadAuthor', '$latestPost', '$views')";
	$result = dbQuery($sql) or die ("Query failed: createForumThread-createThread");
	
	// Add Post
	$postID = getNumForumPosts();
	$sql = "INSERT INTO forumPosts (id, threadID, forumID, subject, post, author, postDate, postTime) VALUES ('$postID', '$threadID', '$forumID', '$threadSubject', '$threadPost', '$threadAuthor', '$threadDate', '$threadTime')";
	$result = dbQuery($sql) or die ("Query failed: createForumThread-addPost");
	
	// $pageID = $threadID; // To Redirect to thread
	addSuccessNotice("Thread Created");
}
?>