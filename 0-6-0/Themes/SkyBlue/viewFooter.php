<?php
// Harris Christiansen
// Created 9-15-12

defaultsInclude('devTools');
defaultsInclude('breadcrumbs');
defaultsInclude('chatSystem');
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

// Chat
displayChatMenuBarItem();

viewHTML('</div>');
?>
</footer>
<div id="breadcrumbsBar">
<?
//// Breadcrumbs Bar ////
viewBreadcrumbs();
?>
</div>
<? //// Chat Window
viewChatWindow();
?>
<br><br>
<?php echo getPageLoadInfo(); ?>
</body></html>