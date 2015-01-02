<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('registerLoginFields');

display('viewHeader');
?>

	<header class="major">
		<h2>Register</h2>
	</header>
	<div class="container">
		<? viewRegisterField(); ?>
	</div>

<?php
display('viewFooter');
?>