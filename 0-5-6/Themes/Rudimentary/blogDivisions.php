<?php
// Harris Christiansen
// Created 2013-12-12

function displayHomePageBlogEntry($authorName,$postDate,$entryTitle,$blogEntry,$blogLink,$numComments) {
	viewHTML('<div class="siteContPanel whitePanel">');
		viewHTML('<div class="hpBlogDate">'.$postDate.'</div>');
		viewHTML('<a class="hpBlogTitle" href="'.$blogLink.'">'.$entryTitle.'<div class="blogAuthor"><br>Comments: '.$numComments.'</div>'.'</a>');
		viewHTML();
		viewHTML('<div class="hpBlogText">'.$blogEntry.'</div>');
	viewHTML('</div>');
}

function displayBlogEntry($authorName,$postDateShort,$postDate,$postTime,$entryTitle,$entry,$updateInfo,$editEntryLink,$deleteEntryLink) {
	viewHTML('<div class="siteContPanel whitePanel">');
		viewHTML('<div class="blogDate">'.$postDateShort.'</div>');
		viewHTML('<div class="blogTitle">'.$entryTitle);
			viewHTML('<div class="blogAuthor">');
				viewHTML('By: '.$authorName.'<br>'.$postDate.' at '.$postTime);
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
		viewHTML('<div class="blogCommentAuthor">By: '.$userName.'<br>'.$commentDate.' at '.$commentTime.'</div>');
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
	viewHtml('</form>');
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