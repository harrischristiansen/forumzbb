<?php
// Harris Christiansen
// Created 9-15-12

defaultsInclude('blogDivisions');

display('viewHeader');

viewHTML('<div id="HomePageBlogEntries">');
viewBlogEntries();
viewHTML('</div>');

viewHTML('<div class="pageChangeBtns">');
if(!isLastPage()) {
	viewHTML('<a class="nextPageButton" href="'.getNextPageLink().'">&larr; Older Entries</a>');
}
if(!isFirstPage()) {
	viewHTML('<a class="backPageButton" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
}
if(userCan('postBlogEntries')) {
	viewHTML('<a class="midButton" href="'.getNewBlogPageLink().'">Add Entry</a>');
}
viewHTML('</div>');

display('viewFooter');
?>