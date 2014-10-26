<?php
// Harris Christiansen
// Created 9-15-12

themeInclude('blogDivisions');
defaultsInclude('registerLoginFields');
global $siteSettings;

display('viewHeader');

viewHTML('<div id="fullSite"><div class="panelHead">Blog</div>');
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

viewHTML('<div class="clearBoth"></div>');

display('viewFooter');
?>