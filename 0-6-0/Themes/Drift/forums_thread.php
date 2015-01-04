<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

themeInclude('forumDivisions');
defaultsInclude('forumComposeDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums"); // Forums
$forumID = getForumIDOfThread($threadID);
addBreadcrumb(getForumTitle($forumID),"forum/".$forumID); // Forum
addBreadcrumb(getThreadTitle($pageID),"thread/".$pageID); // Thread

display('viewHeader');

viewForumThread();

?>
<? if(userCan("createForumPosts")) { ?>
<div id="composeForumPostDiv" style="padding-left: 4px; padding-right: 4px;">
<div class="FullWidthPostHead">
	<div class="floatLeft">Reply:</div>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<? displayReplyComposeField(); ?>
</div>
</div>
<? } ?>

<?

display('viewFooter');

?>