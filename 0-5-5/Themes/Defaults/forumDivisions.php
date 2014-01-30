<?php
// Harris Christiansen
// Created 5-29-13

// Home
function displayForumCatHead($title) {
	viewHTML('<tr class="FullWidthTableHead">');
		viewHTML('<td class="TableHeadColumn forumHomeColumn1">'.$title.'</td>');
		viewHTML('<td class="TableHeadColumn forumHomeColumn2">Threads</td>');
		viewHTML('<td class="TableHeadColumn forumHomeColumn3">Posts</td>');
		viewHTML('<td class="TableHeadColumn forumHomeColumn4">Latest Post</td>');
	viewHTML('</tr>');
}
function displayForumLine($rowID, $title, $desc, $numThreads, $numPosts, $latestPostTitle, $latestPostAuthor, $latestPostDate, $forumLink, $latestPostLink) {
	viewHTML('<tr class="FullWidthTableRow">');
		viewHTML('<td class="TableRowColumn forumHomeColumn1 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">');
			viewHTML($title.'<br>'.$desc);
		viewHTML('</td>');
		viewHTML('<td class="TableRowColumn forumHomeColumn2 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">'.$numThreads.'</td>');
		viewHTML('<td class="TableRowColumn forumHomeColumn3 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$forumLink.'\';">'.$numPosts.'</td>');
		viewHTML('<td class="TableRowColumn forumHomeColumn4 forumHomeRow'.$rowID.'" onclick="parent.location=\''.$latestPostLink.'\';">');
			viewHTML('<div class="floatLeft">'.$latestPostTitle.'</div><br>');
			viewHTML('<div class="floatLeft">By: '.$latestPostAuthor.'</div>');
			viewHTML('<div class="floatRight">'.$latestPostDate.'</div>');
		viewHTML('</td>');
	viewHTML('</tr>');
}

// Threads
function displayForumHead() {
	viewHTML('<tr class="FullWidthTableHead">');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn1">Subject</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn2">Started By</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn3">Latest Post</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn4">Replies</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn5">Views</td>');
	viewHTML('</tr>');
}
function displayThreadLine($threadLink,$rowID,$subject,$startBy,$latestBy,$latestAt,$replies,$views) {
	viewHTML('<tr class="FullWidthTableRow" onclick="parent.location=\''.$threadLink.'\';">');
		viewHTML('<td class="TableRowColumn forumThreadsColumn1 forumThreadsRow'.$rowID.'">'.$subject.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn2 forumThreadsRow'.$rowID.'">'.$startBy.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn3 forumThreadsRow'.$rowID.'">');
			viewHTML('By '.$latestBy.'<br>');
			viewHTML($latestAt);
		viewHTML('</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn4 forumThreadsRow'.$rowID.'">'.$replies.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn5 forumThreadsRow'.$rowID.'">'.$views.'</td>');
	viewHTML('</tr>');
}

// Posts
function displayForumPost($rowID, $author, $authorInfo, $subject, $postDate, $postTime, $post, $viewEdit, $viewDelete, $editLink, $deleteLink, $editText) {
	viewHTML('<table class="FullWidthTable">');
	viewHTML('<tr class="FullWidthTableHead">');
		viewHTML('<td class="TableHeadColumn forumPostColumn1">'.$author.'</td>');
		viewHTML('<td class="TableHeadColumn forumPostColumn2">');
			viewHTML('<div class="floatLeft">'.$subject.'</div>');
			viewHTML('<div class="floatRight">Posted On '.$postDate.' at '.$postTime.'</div>');
		viewHTML('</td>');
	viewHTML('</tr>');
	viewHTML('<tr class="FullWidthTableRow">');
		viewHTML('<td class="TableRowItem forumPostColumn1 forumThreadPost'.$rowID.'">'.$authorInfo.'</td>');
		viewHTML('<td class="TableRowItem forumPostColumn2 forumThreadPost'.$rowID.'">'.$post.'</td>');
	viewHTML('</tr>');
	if($viewEdit||$viewDelete) {
	viewHTML('<tr class="FullWidthTableRow">');
		viewHTML('<td class="TableRowItem forumPostColumn1 forumThreadPost'.$rowID.'"></td>');
		viewHTML('<td class="TableRowItem forumPostColumn2 forumThreadPost'.$rowID.'">');
			if($viewEdit) { viewHTML('<button class="editButton">Edit</button>'); }
			if($viewDelete) { viewHTML('<a href="'.$deleteLink.'"><button>Delete</button></a>'); }
		viewHTML('</td>');
	viewHTML('</tr>');
	}
	if($viewEdit) {
	viewHTML('<tr class="FullWidthTableRow editCommentDiv">');
		viewHTML('<td class="TableRowItem forumPostColumn1 forumThreadPost'.$rowID.'"></td>');
		viewHTML('<td class="TableRowItem forumPostColumn2 forumThreadPost'.$rowID.'">');
			viewHTML('<form action="'.$editLink.'" method="POST" class="validateForm">');
				viewHTML('<textarea name="forumPost" data-bvalidator="required">'.$editText.'</textarea>');
				viewHTML('<input type="submit" name="editForumPostSubmitted" value="Update">');
			viewHtml('</form>');
		viewHTML('</td>');
	viewHTML('</tr>');
	}
	viewHTML('</table>');
}
?>