<?php
// Harris Christiansen
// Created 9-15-12
// Updated 11-03-12

defaultsInclude('breadcrumbs');
?>

<footer id="footBar">
<?php
//// Footer Bar ////

// Left Side
viewHTML('<div class="headFootLeftSide">');

// siteName | siteSlogan
viewHTML(getSiteName()." | ".getSiteSlogan());

// Right Side
viewHTML('</div><div class="headFootRightSide">');

// Date
viewHTML(returnDateLong());

// Center
viewHTML('</div><div class="headFootCenter">');

// Members: numMembers
viewHTML('Members: '.getSiteNumMembers());

viewHTML('</div>');
?>
</footer>
<div id="breadcrumbsBar">
<?php
//// Breadcrumbs Bar ////
viewBreadcrumbs();
?>
</div>
<br><br>
</body></html>