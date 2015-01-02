<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

themeInclude('blogDivisions');
display('viewHeader');
if(checkBlogEntryExists()) {
	viewHTML('<section id="main" class="wrapper style1">');
		viewBlogPageBlogEntry();
	
	viewHTML('<br><hr><h2 class="align-center">Comments</h2>');
	
	viewBlogComments();
	if(userCan('postBlogComments')) { displayAddCommentField(); }
	
	viewHTML('</section>');
}

display('viewFooter');
?>