<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

themeInclude('blogDivisions');
defaultsInclude('registerLoginFields');
global $siteSettings;

display('viewHeader');

?>
		<!-- Blog Posts -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Blog</h2>
				</header>
				<? viewBlogEntries();
				viewHTML('<div class="container align-center">');
					if(!isLastBlogPage()) {
						viewHTML('<a class="button special floatLeft" href="'.getNextPageLink().'">&larr; Older Entries</a>');
					}
					if(!isFirstBlogPage()) {
						viewHTML('<a class="button special floatRight" href="'.getPreviousPageLink().'">Newer Entries &rarr;</a>');
					}
					if(userCan('postBlogEntries')) {
						viewHTML('<a class="button special" href="'.$siteSettings['siteURLShort'].'composeEntry/">Create New Entry</a>');
					}
				viewHTML('</div>'); ?>
			</section>
			
<?
display('viewFooter');
?>