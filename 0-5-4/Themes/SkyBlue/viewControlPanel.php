<?php
// Harris Christiansen
// Created 10-19-12

defaultsInclude('controlPanel');

display('viewHeader');
?>
<div id="controlPanel">
<div id="controlPanelSidepanel">
	<div class="controlPanelSidepanelItem">
		<div class="controlPanelTitle">Navigation</div>
		<div class="controlPanelSidePanelItemContent">
		<?php displayCPNav(); ?>
		</div>
	</div>
	<div class="controlPanelSidepanelItem">
		<div class="controlPanelTitle">Quick Stats</div>
		<div class="controlPanelSidePanelItemContent">
		<? getSiteStats(); ?>
		</div>
	</div>
</div>

<div id="controlPanelContent">
	<div class="controlPanelTitle">Control Panel</div>
	<?php displayCPContent(); ?>
</div>
<div class="clearCont"></div>
</div>

<?php
display('viewFooter');
?>