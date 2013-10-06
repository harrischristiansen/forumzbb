<?php
// Harris Christiansen
// Created 10-6-13

defaultsInclude('forumDivisions');

display('viewHeader');

viewHTML('<div class="forumHomeContainer">');
viewForumThreads();
viewHTML('</div>');

display('viewFooter');

?>