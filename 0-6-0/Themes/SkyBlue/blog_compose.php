<?php
// Harris Christiansen
// Created 5-16-12

defaultsInclude('blogDivisions');

// Breadcrumbs
global $pageID;
if($pageID!="") {
	addBreadcrumb(getBlogEntryTitle($pageID),"blog/".$pageID);
	addBreadcrumb("Edit Blog","editBlog/".$pageID);
}

display('viewHeader');
?>

<div id="composeBlogDiv">
<div class="FullWidthPostHead">
	<? if($pageID!="") { ?>
	<div class="floatLeft">Edit Blog Post:</div>
	<? } else { ?>
	<div class="floatLeft">Compose Blog Post:</div>
	<? } ?>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<?php getBlogComposeField(); ?>
</div>
</div>

<?php
display('viewFooter');
?>