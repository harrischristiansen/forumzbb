<?php
// Harris Christiansen
// Created 11-07-12
// Updated 5-19-13

defaultsInclude('blogDivisions');
display('viewHeader');
if(checkBlogEntryExists()) {
	viewHTML('<div id="BlogPageBlogEntry">');
		viewBlogPageBlogEntry();
	viewHTML('</div>');
	
	viewHTML('<br><hr><h3>Comments</h3><br>');
	
	viewHTML('<div id="BlogPageComments">');
		viewBlogComments();
		if(canPostBlogComments()) { displayAddCommentField(); }
	viewHTML('</div>');
}

display('viewFooter');
?>