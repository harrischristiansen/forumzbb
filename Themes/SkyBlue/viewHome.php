<?php
// Harris Christiansen
// Created 9-15-12
// Updated 11-07-12

defaultsInclude('blogDivisions');

display('viewHeader');

viewBlogEntries();

viewHTML('<div class="pageChangeBtns">');
if(!isLastPage()) {
	viewHTML('<a class="nextPageButton" href="'.getNextPageLink().'">&larr; Older Entries</a>');
}
if(!isFirstPage()) {
	viewHTML('<a class="backPageButton" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
}
viewHTML('</div>');

display('viewFooter');
?>