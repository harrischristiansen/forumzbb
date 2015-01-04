<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

function viewSuccess($msg) {
	viewHTML('<div class="container successMsg">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewFailure($msg) {
	viewHTML('<div class="container failureMsg">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewNotice($msg) {
	viewHTML('<div class="container genMsg">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewImportantNotice($msg) {
	viewHTML('<div class="container imptMsg">');
	viewHTML($msg);
	viewHTML('</div>');
}
?>