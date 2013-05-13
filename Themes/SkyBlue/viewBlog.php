<?php
// Harris Christiansen
// Created 11-07-12
// Updated 5-12-13

defaultsInclude('blogDivisions');
display('viewHeader');

viewHTML('<div id="BlogPageBlogEntry">');
viewBlogPageBlogEntry();
viewHTML('</div>');

viewHTML('<br><hr><h3>Comments</h3><br>');

viewHTML('<div id="BlogPageComments">');
viewBlogComments();
if(isLoggedIn()) { displayAddCommentField(); }
viewHTML('</div>');

display('viewFooter');
?>