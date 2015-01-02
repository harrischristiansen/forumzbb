<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('registerLoginFields');

display('viewHeader');
?>

<section id="main" class="wrapper style1">
	<header class="major">
		<h2>Reset Password</h2>
	</header>
	<div class="container">
		<?php viewPassResetField(); ?>
	</div>
</section>

<?php
display('viewFooter');
?>