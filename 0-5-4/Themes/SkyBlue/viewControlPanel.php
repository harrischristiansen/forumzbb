<?php
// Harris Christiansen
// Created 10-19-12

defaultsInclude('controlPanel');

display('viewHeader');
?>

<div class="FullWidthContentDivision">
<div id="controlPanelNav">
	<?php displayCPNav(); ?>
</div>
<div id="controlPanelContent">
	<?php displayCPContent(); ?>
</div>
</div>

<?php
display('viewFooter');
?>