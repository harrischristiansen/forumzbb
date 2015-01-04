<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('forumDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums");
addBreadcrumb(getForumTitle($pageID),"forum/".$pageID);

display('viewHeader');
?>

	<header class="major">
		<h2><? echo getForumTitle($pageID); ?></h2>
	</header>

<?
if(userCan('createForumPosts')) {
	viewHTML('<div class="container align-center">');
		viewHTML('<a class="button special" href="'.$siteSettings['siteURLShort'].'newForumThread/'.$pageID.'">New Thread</a>');
	viewHTML('</div>');
}


viewHTML('<table>');
	viewForumThreads();
viewHTML('</table>');


display('viewFooter');

?>