<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('forumComposeDivisions');

// Breadcrumbs
global $pageID;
addBreadcrumb("Forums","forums");
addBreadcrumb(getForumTitle($pageID),"forum/".$pageID);
addBreadcrumb("New Thread","newForumThread/".$pageID);

display('viewHeader');
?>

<header class="major"><h2>Compose New Forum Thread:</h2></header>

<div class="container">
	<? displayThreadComposeField(); ?>
</div>

<?php
display('viewFooter');
?>