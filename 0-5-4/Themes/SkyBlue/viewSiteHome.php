<?php
// Harris Christiansen
// Created 9-15-12

defaultsInclude('blogDivisions');
global $siteSettings;

display('viewHeader');

viewHTML('<div id="HomePageBlogEntries">');
viewBlogEntries();
viewHTML('</div>');

viewHTML('<div class="pageChangeBtns">');
if(!isLastBlogPage()) {
	viewHTML('<a class="nextPageButton" href="'.getNextPageLink().'">&larr; Older Entries</a>');
}
if(!isFirstBlogPage()) {
	viewHTML('<a class="backPageButton" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
}
if(userCan('postBlogEntries')) {
	viewHTML('<a class="midButton" href="'.$siteSettings['siteURLShort'].'composeEntry/">Add Entry</a>');
}
viewHTML('</div>');

display('viewFooter');
?>