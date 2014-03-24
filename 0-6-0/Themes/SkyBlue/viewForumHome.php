<?php
// Harris Christiansen
// Created 5-29-13

defaultsInclude('forumDivisions');

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
viewForumHome();
viewHTML('</table>');

display('viewFooter');

?>