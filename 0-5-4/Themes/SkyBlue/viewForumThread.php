<?php
// Harris Christiansen
// Created 2013-11-18

defaultsInclude('forumDivisions');
global $siteSettings, $pageID;

// Breadcrumbs
addBreadcrumb("Forums","forums"); // Forums
$forumID = getForumIDOfThead($threadID);
addBreadcrumb(getForumTitle($forumID),"forum/".$forumID); // Forum
addBreadcrumb(getThreadTitle($pageID),"thread/".$pageID); // Thread

display('viewHeader');

viewForumThread();

display('viewFooter');

?>