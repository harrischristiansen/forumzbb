<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('registerLoginFields');

display('viewHeader');
?>

	<header class="major">
		<h2>Reset Password</h2>
	</header>
	<div class="container">
		<?php viewPassResetField(); ?>
	</div>

<?php
display('viewFooter');
?>