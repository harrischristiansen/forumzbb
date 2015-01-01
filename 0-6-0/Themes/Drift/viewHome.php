<?
// Harris Christiansen
// Created 2014-12-31
	
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
				
				<div class="container">
					<h3>Blog Title</h3>
					<p>Blog Post</p>
					<a href="#" class="button">Read More</a>
				</div>
				
				<div class="container">
					<h3>Blog Title</h3>
					<p>Blog Post</p>
					<a href="#" class="button">Read More</a>
				</div>
			</section>
			
		<!-- CTA -->
			<section id="cta" class="wrapper style3">
				<h2>About</h2>
				<p style="max-width: 600px; margin-left: auto; margin-right: auto;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</section>

<?
	display('viewFooter');
?>