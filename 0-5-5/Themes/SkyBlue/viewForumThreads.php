<?php
// Harris Christiansen
// Created 10-6-13

defaultsInclude('forumDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums");
addBreadcrumb(getForumTitle($pageID),"forum/".$pageID);

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
viewForumThreads();
viewHTML('</table>');

viewHTML('<div class="pageChangeBtns">');
/*if(!isLastForumPage()) {
	viewHTML('<a class="nextPageButton" href="'.getNextPageLink().'">&larr; Older Entries</a>');
}
if(!isFirstForumPage()) {
	viewHTML('<a class="backPageButton" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
}
*/
if(userCan('createForumPosts')) {
	viewHTML('<a class="midButton" href="'.$siteSettings['siteURLShort'].'newForumThread/'.$pageID.'">New Thread</a>');
}
viewHTML('</div>');

display('viewFooter');

?>