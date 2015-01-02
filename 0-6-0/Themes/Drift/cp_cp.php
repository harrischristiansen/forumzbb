<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('controlPanel');

display('viewHeader');
?>
<section id="main" class="wrapper style1">
	<header class="major">
		<h2>Control Panel</h2>
	</header>
	
	<div class="container">
		<h3 class="align-center">Navigation</h3>
		<? displayCPNav(); ?>
	</div>
	
	<div class="container">
		<? displayCPContent(); ?>
	</div>
	
	<div class="container">
		<h3>Quick Stats</h3>
		<? getSiteStats(); ?>
	</div>
</section>

<?php
display('viewFooter');
?>