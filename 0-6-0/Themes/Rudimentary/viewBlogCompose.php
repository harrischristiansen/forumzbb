<?php
// Harris Christiansen
// Created 5-16-12

themeInclude('blogDivisions');

// Breadcrumbs
global $pageID;
if($pageID!="") {
	addBreadcrumb(getBlogEntryTitle($pageID),"blog/".$pageID);
	addBreadcrumb("Edit Blog","editBlog/".$pageID);
}

display('viewHeader');
?>

<div id="composeBlogDiv">
<div class="panelHead">
	<? if($pageID!="") { ?>
	Edit Blog Post:
	<? } else { ?>
	Compose Blog Post:
	<? } ?>
</div>
<div class="siteContPanel whitePanel" style="text-align: center;">
<?php getBlogComposeField(); ?>
</div>
</div>

<?php
display('viewFooter');
?>