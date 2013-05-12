<?php
// Harris Christiansen
// Created 11-07-12
// Updated 5-12-12

defaultsInclude('blogDivisions');
display('viewHeader');

viewHTML('<div id="BlogPageBlogEntry">');
viewBlogPageBlogEntry();
viewHTML('</div>');

display('viewFooter');
?>