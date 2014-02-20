<?php
// Harris Christiansen
// Created 10-1-12

defaultsInclude('registerLoginFields');

display('viewHeader');
?>
<div class="fullSite">
	<div class="panelHead">Register</div>
	<div class="siteContPanel whitePanel">
		<?php viewRegisterField(); ?>
	</div>
</div>

<?php
display('viewFooter');
?>