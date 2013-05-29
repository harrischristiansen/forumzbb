<?php
// Harris Christiansen
// Created 5-16-12
// Updated 5-28-13

defaultsInclude('blogDivisions');
display('viewHeader');
?>

<div id="composeBlogDiv">
<div class="FullWidthPostHead">
	<div class="floatLeft">Compose Blog Post:</div>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<?php getBlogComposeField(); ?>
</div>
</div>

<?php
display('viewFooter');
?>