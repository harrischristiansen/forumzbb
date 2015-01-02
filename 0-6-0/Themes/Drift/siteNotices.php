<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

function viewSuccess($msg) {
	viewHTML('<div class="container" style="background-color: green;">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewFailure($msg) {
	viewHTML('<div class="container" style="background-color: red;">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewNotice($msg) {
	viewHTML('<div class="container"">');
	viewHTML($msg);
	viewHTML('</div>');
}

function viewImportantNotice($msg) {
	viewHTML('<div class="container" style="background-color: yellow;">');
	viewHTML($msg);
	viewHTML('</div>');
}
?>