<?php
// Harris Christiansen
// Created 5-16-12
// Updated 5-16-13

defaultsInclude('blogDivisions');
display('viewHeader');
?>


<div class="FullWidthContentDivision centerInnerContent">
Compose Blog Post:<br>
<br>
<?php displayBlogComposeField(); ?>
</div>

<?php
display('viewFooter');
?>