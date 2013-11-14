<?php
// Harris Christiansen
// Created 5-29-13
// Updated 5-29-13

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
?>