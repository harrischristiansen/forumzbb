<?php
// Harris Christiansen
// Created 9-15-12

themeInclude('blogDivisions');
defaultsInclude('registerLoginFields');
global $siteSettings;

display('viewHeader');

viewHTML('<div id="leftSite"><div class="panelHead">Blog</div>');
	viewBlogEntries();
	if(!isLastBlogPage()) {
		viewHTML('<a class="siteButton floatLeft" href="'.getNextPageLink().'">&larr; Older Entries</a>');
	}
	if(!isFirstBlogPage()) {
		viewHTML('<a class="siteButton floatRight" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
	}
	if(userCan('postBlogEntries')) {
		viewHTML('<a class="newItemBtn" href="'.$siteSettings['siteURLShort'].'composeEntry/">Add Entry</a>');
	}
viewHTML('</div>');

viewHTML('<div id="rightSite">');
	viewHTML('<div class="panelHead">Recent Mentor Posts</div>');		
	viewMentorBlogEntries();
viewHTML('</div>');

viewHTML('<div class="clearBoth"></div>');

display('viewFooter');
?>