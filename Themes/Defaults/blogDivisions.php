<?php
// Harris Christiansen
// Created 11-03-12
// Updated 5-12-12

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

function displayBlogEntry($authorName,$postDate,$postTime,$entryTitle,$entry) {
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("By: ".$authorName);
		viewHTML('</div>');
		viewHTML('<div class="floatRight">');
			viewHTML("Posted: ".$postDate." at ".$postTime);
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow">');
		viewHTML('<div class="hpBlogTitleLine">');
			viewHTML($entryTitle);
		viewHTML('</div>');
		viewHTML('<hr>');
		viewHTML($entry);
	viewHTML('</div>');
	viewHTML("<br><br>");
}

function displayBlogComment($userName,$commentDate,$commentTime,$comment) {
	viewHTML('<div class="FullWidthPostHead">');
		viewHTML('<div class="floatLeft">');
			viewHTML("Comment By: ".$userName);
		viewHTML('</div>');
		viewHTML('<div class="floatRight">');
			viewHTML("Reply Posted: ".$commentDate." at ".$commentTime);
		viewHTML('</div>');
	viewHTML('</div>');
	viewHTML('<div class="FullWidthPostRow">');
		viewHTML($comment);
	viewHTML('</div>');
	viewHTML("<br><br>");
}
?>