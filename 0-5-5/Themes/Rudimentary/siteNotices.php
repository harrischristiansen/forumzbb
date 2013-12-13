<?php
// Harris Christiansen
// Created 10-3-12

function viewSuccess($msg) {
	viewHTML('<div class="fullSite">');
	viewHTML('<div class="siteContPanel greenPanel">');
	viewHTML($msg);
	viewHTML('</div>');
	viewHTML('</div>');
}

function viewFailure($msg) {
	viewHTML('<div class="fullSite">');
	viewHTML('<div class="siteContPanel redPanel">');
	viewHTML($msg);
	viewHTML('</div>');
	viewHTML('</div>');
}

function viewNotice($msg) {
	viewHTML('<div class="fullSite">');
	viewHTML('<div class="siteContPanel whitePanel">');
	viewHTML($msg);
	viewHTML('</div>');
	viewHTML('</div>');
}

function viewImportantNotice($msg) {
	viewHTML('<div class="fullSite">');
	viewHTML('<div class="siteContPanel whitePanel">');
	viewHTML($msg);
	viewHTML('</div>');
	viewHTML('</div>');
}
?>