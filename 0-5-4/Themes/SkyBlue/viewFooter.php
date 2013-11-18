<?php
// Harris Christiansen
// Created 9-15-12

defaultsInclude('devTools');
defaultsInclude('breadcrumbs');
?>

<footer id="footBar">
<?php
//// Footer Bar ////

// Left Side
viewHTML('<div class="footLeftSide">');

// siteName | siteSlogan
viewHTML(getSiteName()." | ".getSiteSlogan().' | Powered By <a href="http://www.forumzbb.com/" target="_blank">ForumzBB</a>');

// Right Side
viewHTML('</div><div class="footRightSide">');

// Date
viewHTML(returnDateLong());

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
<?php echo getPageLoadInfo(); ?>
</body></html>