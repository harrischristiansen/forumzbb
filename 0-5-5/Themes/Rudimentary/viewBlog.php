<?php
// Harris Christiansen
// Created 11-07-12

themeInclude('blogDivisions');
display('viewHeader');
if(checkBlogEntryExists()) {
	viewHTML('<div id="BlogPageBlogEntry">');
		viewBlogPageBlogEntry();
	viewHTML('</div>');
	
	viewHTML('<br><hr><div class="panelHead">Comments</div><br>');
	
	viewHTML('<div id="BlogPageComments">');
		viewBlogComments();
		if(userCan('postBlogComments')) { displayAddCommentField(); }
	viewHTML('</div>');
}

display('viewFooter');
?>