<?php
// Harris Christiansen
// Created 11-03-12

function displayHomePageBlogEntry($authorName,$postDate,$entryTitle,$blogEntry,$blogLink) {
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

function displayBlogEntry($authorName,$postDate,$postTime,$entryTitle,$entry,$editEntryLink,$deleteEntryLink) {
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

function displayBlogComment($userName,$commentDate,$commentTime,$comment) {
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
	viewHTML('</div>');
}

function displayBlogComposeField($formLink, $updatingPost, $currentEntry) {
	viewHTML('<form action="'.$formLink.'" method="POST">');
	if(!$updatingPost) {
		viewHTML('<input type="text" name="blogEntryTitle" value="Blog Entry Title" placeholder="Blog Entry Title" onfocus="this.value=\'\';"><br>');
	}
	viewHTML('Entry:<br><textarea name="blogEntryText" class="newBlogEntryTextArea">'.$currentEntry.'</textarea><br>');
	if($updatingPost) {
		viewHTML('<input type="submit" name="blogUpdateSubmitted" value="Update">');
	} else {
		viewHTML('<input type="submit" name="blogComposeSubmitted" value="Post">');
	}
	viewHtml('</form>');
}

function displayAddCommentField() {
	global $siteSettings, $pageID;
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("Reply:");
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow" style="text-align: center;">');
		viewHTML('<form action="'.$siteSettings['siteURLShort'].'blog/'.$pageID.'/reply" method="POST">');
			viewHTML('<textarea class="blogCommentTextArea" name="blogCommentText"></textarea><br>');
			viewHTML('<input type="submit" name="commentSubmitted" value="Reply">');
		viewHtml('</form>');
	viewHTML('</div>');
}
?>