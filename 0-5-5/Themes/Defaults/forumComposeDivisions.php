<?php
// Harris Christiansen
// Created 2013-11-18

function displayThreadComposeField() {
	global $siteSettings, $pageID;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'newForumThread/'.$pageID.'" method="POST" class="validateForm">');
	viewHTML('Subject: <input type="text" name="threadSubject" value="Subject" placeholder="Subject" onfocus="this.value=\'\';" data-bvalidator="required"><br>');
	viewHTML('Post:<br><textarea name="threadPost" class="newForumThreadTextArea sceditor" data-bvalidator="required"></textarea><br>');
	viewHTML('<input type="submit" name="threadComposeSubmitted" value="Post">');
	viewHtml('</form>');
}

function displayReplyComposeField() {
	global $siteSettings, $pageID;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'newForumPost/'.$pageID.'" method="POST" class="validateForm">');
	viewHTML('<textarea name="threadPost" class="newForumPostTextArea sceditor" data-bvalidator="required"></textarea><br>');
	viewHTML('<input type="submit" name="replyComposeSubmitted" value="Reply">');
	viewHtml('</form>');
}

?>