<?php
// Harris Christiansen
// Created 2013-11-18

function displayThreadComposeField() {
	global $siteSettings, $pageID;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'newForumThread/'.$pageID.'" method="POST" class="validateForm">');
	viewHTML('Subject: <input type="text" name="threadSubject" value="" placeholder="Subject" onfocus="this.value=\'\';" data-bvalidator="required"><br>');
	viewHTML('Post:<br><textarea name="threadPost" class="newForumThreadTextArea sceditor" data-bvalidator="required"></textarea><br>');
	viewHTML('<input type="submit" name="threadComposeSubmitted" class="special" value="Post">');
	viewHtml('</form><br><br>');

	// File Uploader
	viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
		viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
	viewHTML('</form>');
	viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
}

function displayReplyComposeField() {
	global $siteSettings, $pageID;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'newForumPost/'.$pageID.'" method="POST" class="validateForm">');
	viewHTML('<textarea name="threadPost" class="newForumPostTextArea sceditor" data-bvalidator="required"></textarea><br>');
	viewHTML('<input type="submit" name="replyComposeSubmitted" class="special" value="Reply">');
	viewHtml('</form><br><br>');

	// File Uploader
	viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
		viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
	viewHTML('</form>');
	viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
}

?>