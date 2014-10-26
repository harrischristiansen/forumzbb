<?php
// Harris Christiansen
// Created 10-1-12

defaultsInclude('registerLoginFields');

display('viewHeader');
?>

<div class="FullWidthContentDivision centerInnerContent">
Reset Password:<br>
<br>
<?php viewPassResetField(); ?>
</div>

<?php
display('viewFooter');
?>