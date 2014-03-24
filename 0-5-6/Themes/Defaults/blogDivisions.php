<?php
// Harris Christiansen
// Created 11-03-12

function displayHomePageBlogEntry($authorName,$postDate,$entryTitle,$blogEntry,$blogLink,$numComments) {
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("By: ".$authorName);
		viewHTML('</div>');
		viewHTML('<div class="floatRight">');
			viewHTML($postDate);
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow">');
		viewHTML('<div class="hpBlogTitleLine"><div class="floatLeft">');
			viewHTML($entryTitle);
		viewHTML('</div><div class="floatRight">');
			viewHTML('<a href="'.$blogLink.'">Read More &rarr;</a>');
		viewHTML('</div></div>');
		viewHTML('<hr>');
		viewHTML($blogEntry);
	viewHTML('</div>');
}

function displayBlogEntry($authorName,$postDateShort,$postDate,$postTime,$entryTitle,$entry,$updateInfo,$editEntryLink,$deleteEntryLink) {
	viewHTML('<div class="FullWidthPostHead">'); // Blog Entry Head
		viewHTML('<div class="floatLeft">');
			viewHTML("By: ".$authorName);
		viewHTML('</div>');
		viewHTML('<div class="floatRight">');
			viewHTML("Posted: ".$postDate." at ".$postTime);
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow">'); // Blog Entry Content
		viewHTML('<div class="hpBlogTitleLine">');
			viewHTML($entryTitle);
		viewHTML('</div>');
		viewHTML('<hr>');
		viewHTML($entry);
		// Updated Entry Info
		if($updateInfo!="") {
			viewHTML('<hr>');
			viewHTML('<div style="font-size: 10px;">');
				viewHTML($updateInfo);
			viewHTML('</div>');
		}
		// Admin Functions
		if($editEntryLink!=""||$deleteEntryLink!="") {
			viewHTML('<hr>');
			viewHTML('<div class="floatRight">');
				if($editEntryLink!="") { viewHTML('<a href="'.$editEntryLink.'"><button>Edit</button></a>'); }
				if($deleteEntryLink!="") { viewHTML('<a href="'.$deleteEntryLink.'"><button>Delete</button></a>'); }
			viewHTML('</div>');
		}
	viewHTML('</div>');
}

function displayBlogComment($userName,$commentDate,$commentTime,$comment,$viewEdit,$viewDelete,$editLink,$deleteLink,$editText) {
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("Comment By: ".$userName);
		viewHTML('</div>');
		viewHTML('<div class="floatRight">');
			viewHTML("Comment Posted: ".$commentDate." at ".$commentTime);
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow">');
		viewHTML($comment);
		if($viewEdit||$viewDelete) {
			viewHTML('<br><hr>');
			if($viewEdit) { viewHTML('<button class="editButton">Edit</button>'); }
			if($viewDelete) { viewHTML('<a href="'.$deleteLink.'"><button>Delete</button></a>'); }
		}
		if($viewEdit) {
			viewHTML('<div class="editCommentDiv">');
			viewHTML('<form action="'.$editLink.'" method="POST" class="validateForm">');
				viewHTML('<textarea name="blogComment" data-bvalidator="required">'.$editText.'</textarea>');
				viewHTML('<input type="submit" name="editBlogCommentSubmitted" value="Update">');
			viewHtml('</form>');
			viewHTML('</div>');
			
		}
	viewHTML('</div>');
}

function displayBlogComposeField($formLink, $updatingPost, $currentTitle, $currentEntry) {
	viewHTML('<form action="'.$formLink.'" method="POST" class="validateForm">');
	if(!$updatingPost) {
		viewHTML('<input type="text" name="blogEntryTitle" value="'.$currentTitle.'" placeholder="Blog Entry Title" data-bvalidator="required"><br>');
	}
	viewHTML('Entry:<br><textarea name="blogEntryText" class="newBlogEntryTextArea sceditor" data-bvalidator="required">'.$currentEntry.'</textarea><br>');
	if($updatingPost) {
		viewHTML('<input type="submit" name="blogUpdateSubmitted" value="Update">');
	} else {
		viewHTML('<input type="submit" name="blogComposeSubmitted" value="Post">');
	}
	viewHTML('</form><br><br>');

	// File Uploader
	viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
		viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
	viewHTML('</form>');
	viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
}

function displayAddCommentField() {
	global $siteSettings, $pageID;
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("Reply:");
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow" style="text-align: center;">');
		viewHTML('<form action="'.$siteSettings['siteURLShort'].'blog/'.$pageID.'/reply" method="POST" class="validateForm">');
			viewHTML('<textarea class="blogCommentTextArea sceditor" name="blogCommentText" data-bvalidator="required"></textarea><br>');
			viewHTML('<input type="submit" name="commentSubmitted" value="Reply">');
		viewHtml('</form>');
	viewHTML('</div>');
}
?>