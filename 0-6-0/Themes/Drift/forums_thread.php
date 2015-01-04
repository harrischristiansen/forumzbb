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

?>

	<header class="major">
		<h2><? echo getThreadTitle($pageID); ?></h2>
	</header>

<? viewForumThread(); ?>


<? if(userCan("createForumPosts")) { ?>
	<hr>
	<h3 class="align-center">Reply:</h3>
	<div class="container">
		<? displayReplyComposeField(); ?>
	</div>
<? } ?>

<?

display('viewFooter');

?>