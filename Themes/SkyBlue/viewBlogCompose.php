<?php
// Harris Christiansen
// Created 5-16-12
// Updated 5-16-13

defaultsInclude('blogDivisions');
display('viewHeader');
?>

<div id="composeBlogDiv">
<div class="FullWidthPostHead">
	<div class="floatLeft">Compost Blog Post:</div>
</div>
<div class="FullWidthPostRow" style="text-align: center;">
<?php displayBlogComposeField(); ?>
</div>
</div>

<?php
display('viewFooter');
?>