<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

function displayHomePageBlogEntry($authorName,$postDate,$entryTitle,$blogEntry,$blogLink,$numComments) {
	$postDate = str_replace("<br>"," ",$postDate);
	viewHTML('<div class="container">');
		viewHTML('<a href="'.$blogLink.'" class="align-center"><h3>'.$entryTitle.'</h3></a>');
		viewHTML('<h5>By '.$authorName.' on '.$postDate.' - Comments: '.$numComments.'</h5>');
		viewHTML('<p>'.$blogEntry.'</p>');
		viewHTML('<a href="'.$blogLink.'" class="button">Read More</a>');
	viewHTML('</div>');
}

function displayBlogEntry($authorName,$postDateShort,$postDate,$entryTitle,$entry,$updateInfo,$editEntryLink,$deleteEntryLink) {
	viewHTML('<div class="container">');
		viewHTML('<h3>'.$entryTitle.'</h3>');
		viewHTML('<h5>By '.$authorName.' on '.$postDate.' '.$updateInfo.'</h5>');
		viewHTML('<p>'.$entry.'</p>');
		viewHTML('<a href="'.$blogLink.'" class="button">Read More</a>');
		if($editEntryLink!=""||$deleteEntryLink!="") {
			viewHTML('<hr>');
			if($editEntryLink!="") { viewHTML('<a href="'.$editEntryLink.'" style="button special small">Edit</a>'); }
			if($deleteEntryLink!="") { viewHTML('<a href="'.$deleteEntryLink.'" style="button small">Delete</a>'); }
		}
	viewHTML('</div>');
}

function displayBlogComment($userName,$commentDate,$commentTime,$comment,$viewEdit,$viewDelete,$editLink,$deleteLink,$editText) {
	viewHTML('<div class="container">');
		viewHTML('<h5>By '.$userName.' on '.returnDateTimeView($commentDate,$commentTime).'</h5>');
		viewHTML('<p>'.$comment.'</p>');
		viewHTML('<a href="'.$blogLink.'" class="button">Read More</a>');
		if($viewEdit||$viewDelete) {
			viewHTML('<br><hr>');
			if($viewEdit) { viewHTML('<button class="button special small">Edit</button>'); }
			if($viewDelete) { viewHTML('<a href="'.$deleteLink.'" class="button small">Delete</a>'); }
		}
	viewHTML('</div>');
	/*
		if($viewEdit) {
			viewHTML('<div class="editCommentDiv"><hr><br>');
			viewHTML('<form action="'.$editLink.'" method="POST" class="validateForm">');
				viewHTML('<textarea name="blogComment" data-bvalidator="required">'.$editText.'</textarea>');
				viewHTML('<input type="submit" name="editBlogCommentSubmitted" value="Update">');
			viewHtml('</form>');
			viewHTML('</div>');
			
		}
	*/
}

function displayBlogComposeField($formLink, $updatingPost, $currentTitle, $currentEntry) {
	global $siteSettings, $pageID;
	viewHTML('<div class="container">');
	
	viewHTML('<form action="'.$formLink.'" method="POST" class="validateForm">');
		viewHTML('<input type="text" name="blogEntryTitle" value="'.$currentTitle.'" placeholder="Blog Entry Title" data-bvalidator="required"><br>');
		viewHTML('Entry:<br><textarea name="blogEntryText" class="sceditor" data-bvalidator="required">'.$currentEntry.'</textarea><br>');
		if($updatingPost) {
			viewHTML('<input type="submit" name="blogUpdateSubmitted" value="Update">');
		} else {
			viewHTML('<input type="submit" name="blogComposeSubmitted" value="Post">');
		}
	viewHtml('</form>');

	// File Uploader
	viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
		viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
	viewHTML('</form>');
	viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
	
	viewHTML('</div>');
}

function displayAddCommentField() {
	global $siteSettings, $pageID;
	viewHTML('<div class="container">');
		viewHTML('<h3>Reply</h3>');
		viewHTML('<form action="'.$siteSettings['siteURLShort'].'blog/'.$pageID.'/reply" method="POST" class="validateForm">');
			viewHTML('<textarea class="sceditor" name="blogCommentText" data-bvalidator="required"></textarea><br>');
			viewHTML('<input type="submit" name="commentSubmitted" value="Reply">');
		viewHtml('</form>');
	viewHTML('</div>');
}
?>