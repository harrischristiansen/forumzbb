<?
// Harris Christiansen
// Created 2014-12-31
// Theme: Drift

themeInclude('blogDivisions');

display('viewHeader');
?>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h2><? echo getSiteName(); ?></h2>
				</div>
			</section>
			
		<!-- Recent Blog Posts -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Recent Posts</h2>
				</header>
				
				<? if(userCan('postBlogEntries')) {
					viewHTML('<div class="align-center">');
						viewHTML('<a class="button special" href="'.$siteSettings['siteURLShort'].'composeEntry/">Create New Entry</a>');
					viewHTML('</div><br><br>');
				} ?>
				
				<? viewBlogEntries(); ?>
			</section>
			
		<? if($siteSettings['siteAbout']!="") { ?>
		<!-- About-->
			
			<section id="about" class="wrapper style3">
				<h2>About</h2>
				<p style="max-width: 600px; margin-left: auto; margin-right: auto;"><? echo $siteSettings['siteAbout']; ?></p>
			</section>
		<? } ?>

<?
	display('viewFooter');
?>