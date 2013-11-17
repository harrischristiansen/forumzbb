<?php
// Harris Christiansen
// Created 10-6-13

defaultsInclude('forumDivisions');

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
viewForumThreads();
viewHTML('</table>');

display('viewFooter');

?>