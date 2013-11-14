<?php
// Harris Christiansen
// Created 5-29-13

// Home
function displayForumCatHead($title) {
	viewHTML('<div class="FullWidthTableHead">');
		viewHTML('<div class="TableHeadColumn forumHomeColumn1">'.$title.'</div>');
		viewHTML('<div class="TableHeadColumn forumHomeColumn2">Threads</div>');
		viewHTML('<div class="TableHeadColumn forumHomeColumn3">Posts</div>');
		viewHTML('<div class="TableHeadColumn forumHomeColumn4">Latest Post</div>');
	viewHTML('</div>');
}
function displayForumLine($rowID, $title, $desc, $numThreads, $numPosts, $latestPostTitle, $latestPostAuthor, $latestPostDate, $forumLink, $latestPostLink) {
	viewHTML('<div class="FullWidthTableRow">');
		viewHTML('<div class="TableRowColumn forumHomeColumn1 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">');
			viewHTML('<div class="forumHomeMultilineText floatLeft">'.$title.'<br>'.$desc.'</div>');
		viewHTML('</div>');
		viewHTML('<div class="TableRowColumn forumHomeColumn2 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">'.$numThreads.'</div>');
		viewHTML('<div class="TableRowColumn forumHomeColumn3 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">'.$numPosts.'</div>');
		viewHTML('<div class="TableRowColumn forumHomeColumn4 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$latestPostLink.'\';">');
			viewHTML('<div class="forumHomeMultilineText floatLeft">'.$latestPostTitle.'</div><br>');
			viewHTML('<div class="forumHomeMultilineText floatLeft">By: '.$latestPostAuthor.'</div>');
			viewHTML('<div class="forumHomeMultilineText floatRight">'.$latestPostDate.'</div>');
		viewHTML('</div>');
	viewHTML('</div>');
}

// Threads
function displayForumHead() {
	viewHTML('<div class="FullWidthTableHead">');
		viewHTML('<div class="TableHeadColumn forumThreadsColumn1">Subject</div>');
		viewHTML('<div class="TableHeadColumn forumThreadsColumn2">Started By</div>');
		viewHTML('<div class="TableHeadColumn forumThreadsColumn3">Latest Post</div>');
		viewHTML('<div class="TableHeadColumn forumThreadsColumn4">Replies</div>');
		viewHTML('<div class="TableHeadColumn forumThreadsColumn5">Views</div>');
	viewHTML('</div>');
}
function displayThreadLine($rowID,$subject,$startBy,$latestBy,$replies,$views) {
	viewHTML('<div class="FullWidthTableRow">');
		viewHTML('<div class="TableRowColumn forumThreadsColumn1 forumThreadsRow'.$rowID.'">'.$subject.'</div>');
		viewHTML('<div class="TableRowColumn forumThreadsColumn2 forumThreadsRow'.$rowID.'">'.$startBy.'</div>');
		viewHTML('<div class="TableRowColumn forumThreadsColumn3 forumThreadsRow'.$rowID.'">'.$latestBy.'</div>');
		viewHTML('<div class="TableRowColumn forumThreadsColumn4 forumThreadsRow'.$rowID.'">'.$replies.'</div>');
		viewHTML('<div class="TableRowColumn forumThreadsColumn5 forumThreadsRow'.$rowID.'">'.$views.'</div>');
	viewHTML('</div>');
}
?>