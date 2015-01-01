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
	viewHTML('<div class="siteContPanel whitePanel">');
		viewHTML('<div class="blogDate">'.$postDateShort.'</div>');
		viewHTML('<div class="blogTitle">'.$entryTitle);
			viewHTML('<div class="blogAuthor">');
				viewHTML('By: '.$authorName.'<br>'.$postDate);
				// Updated Entry Info
				if($updateInfo!="") { viewHTML('<br>'.$updateInfo); }
			viewHTMl('</div>');
		viewHTML('</div>');
		viewHTML('<div class="blogText">'.$entry.'</div>');
		// Admin Functions
		if($editEntryLink!=""||$deleteEntryLink!="") {
			viewHTML('<hr>');
			if($editEntryLink!="") { viewHTML('<a href="'.$editEntryLink.'"><button>Edit</button></a>'); }
			if($deleteEntryLink!="") { viewHTML('<a href="'.$deleteEntryLink.'"><button>Delete</button></a>'); }
		}
	viewHTML('</div>');
}

function displayBlogComment($userName,$commentDate,$commentTime,$comment,$viewEdit,$viewDelete,$editLink,$deleteLink,$editText) {
	viewHTML('<div class="siteContPanel whitePanel">');
		viewHTML('<div class="blogCommentAuthor">By: '.$userName.'<br>'.returnDateTimeView($commentDate,$commentTime).'</div>');
		viewHTML('<div class="blogCommentText">'.$comment.'</div>');
		viewHTML('<div class="clearBoth"></div>');
		if($viewEdit||$viewDelete) {
			viewHTML('<br><hr>');
			if($viewEdit) { viewHTML('<button class="editButton">Edit</button>'); }
			if($viewDelete) { viewHTML('<a href="'.$deleteLink.'"><button>Delete</button></a>'); }
		}
		if($viewEdit) {
			viewHTML('<div class="editCommentDiv"><hr><br>');
			viewHTML('<form action="'.$editLink.'" method="POST" class="validateForm">');
				viewHTML('<textarea name="blogComment" data-bvalidator="required">'.$editText.'</textarea>');
				viewHTML('<input type="submit" name="editBlogCommentSubmitted" value="Update">');
			viewHtml('</form>');
			viewHTML('</div>');
			
		}
	viewHTML('</div>');
}

function displayBlogComposeField($formLink, $updatingPost, $currentTitle, $currentEntry) {
	global $siteSettings, $pageID;
	viewHTML('<form action="'.$formLink.'" method="POST" class="validateForm newBlogEntry">');
		viewHTML('<input type="text" name="blogEntryTitle" value="'.$currentTitle.'" placeholder="Blog Entry Title" data-bvalidator="required"><br>');
		viewHTML('Entry:<br><textarea name="blogEntryText" class="newBlogEntryTextArea sceditor" data-bvalidator="required">'.$currentEntry.'</textarea><br>');
		if($updatingPost) {
			viewHTML('<input type="submit" name="blogUpdateSubmitted" value="Update">');
		} else {
			viewHTML('<input type="submit" name="blogComposeSubmitted" value="Post">');
		}
	viewHtml('</form><br><br>');

	// File Uploader
	viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
		viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
	viewHTML('</form>');
	viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
}

function displayAddCommentField() {
	global $siteSettings, $pageID;
	viewHTML('<div class="panelHead">Reply:</div>');
	viewHTML('<div class="siteContPanel whitePanel">');
		viewHTML('<form action="'.$siteSettings['siteURLShort'].'blog/'.$pageID.'/reply" method="POST" class="validateForm newBlogComment">');
			viewHTML('<textarea class="blogCommentTextArea sceditor" name="blogCommentText" data-bvalidator="required"></textarea><br>');
			viewHTML('<input type="submit" name="commentSubmitted" value="Reply">');
		viewHtml('</form>');
	viewHTML('</div>');
}
?>