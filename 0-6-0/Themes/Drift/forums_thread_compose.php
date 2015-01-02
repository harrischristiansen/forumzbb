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

<div id="composeForumThreadDiv">
<div class="FullWidthPostHead">
	<div class="floatLeft">Compose New Forum Thread:</div>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<? displayThreadComposeField(); ?>
</div>
</div>

<?php
display('viewFooter');
?>