<?php
// Harris Christiansen
// Created 5-29-13

defaultsInclude('forumDivisions');

display('viewHeader');

viewHTML('<div class="forumHomeContainer">');
viewForumHome();
viewHTML('</div>');

display('viewFooter');

?>