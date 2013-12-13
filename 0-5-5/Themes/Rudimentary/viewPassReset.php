<?php
// Harris Christiansen
// Created 10-1-12

defaultsInclude('registerLoginFields');

display('viewHeader');
?>

<div class="fullSite">
	<div class="panelHead">Reset Password</div>
	<div class="siteContPanel whitePanel">
		<?php viewPassResetField(); ?>
	</div>
</div>

<?php
display('viewFooter');
?>