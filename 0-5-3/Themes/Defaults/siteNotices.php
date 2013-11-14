<?php
// Harris Christiansen
// Created 10-3-12
// Updated 10-9-12

function viewSuccess($msg) {
	viewHTML('<div class="FullWidthSuccessDivision">');
	viewHTML($msg);
	viewHTML('</div><br><br>');
}

function viewFailure($msg) {
	viewHTML('<div class="FullWidthFailureDivision">');
	viewHTML($msg);
	viewHTML('</div><br><br>');
}

function viewNotice($msg) {
	viewHTML('<div class="centerMsgClearBG">');
	viewHTML($msg);
	viewHTML('</div><br><br>');
}

function viewImportantNotice($msg) {
	viewHTML('<div class="FullWidthContentDivision">');
	viewHTML($msg);
	viewHTML('</div><br><br>');
}
?>