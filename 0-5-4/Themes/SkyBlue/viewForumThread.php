<?php
// Harris Christiansen
// Created 2013-11-18

defaultsInclude('forumDivisions');
defaultsInclude('forumComposeDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums"); // Forums
$forumID = getForumIDOfThead($threadID);
addBreadcrumb(getForumTitle($forumID),"forum/".$forumID); // Forum
addBreadcrumb(getThreadTitle($pageID),"thread/".$pageID); // Thread

display('viewHeader');

viewForumThread();

?>
<div id="composeForumPostDiv" style="padding-left: 4px; padding-right: 4px;">
<div class="FullWidthPostHead">
	<div class="floatLeft">Reply:</div>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<? displayReplyComposeField(); ?>
</div>
</div>

<?

display('viewFooter');

?>