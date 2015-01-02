w<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('forumDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums");
addBreadcrumb(getForumTitle($pageID),"forum/".$pageID);

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
viewForumThreads();
viewHTML('</table>');


if(userCan('createForumPosts')) {
	viewHTML('<a class="newItemBtn" href="'.$siteSettings['siteURLShort'].'newForumThread/'.$pageID.'">New Thread</a>');
}

display('viewFooter');

?>