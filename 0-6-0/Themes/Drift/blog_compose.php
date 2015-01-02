<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

themeInclude('blogDivisions');

// Breadcrumbs
global $pageID;
if($pageID!="") {
	addBreadcrumb(getBlogEntryTitle($pageID),"blog/".$pageID);
	addBreadcrumb("Edit Blog","editBlog/".$pageID);
}

display('viewHeader');
?>

<section id="main" class="wrapper style1">

	<header class="major"><h2>
		<? if($pageID!="") { ?>
		Edit Blog Post:
		<? } else { ?>
		Compose Blog Post:
		<? } ?>
	</h2></header>
	
	<? getBlogComposeField(); ?>
</section>

<?php
display('viewFooter');
?>