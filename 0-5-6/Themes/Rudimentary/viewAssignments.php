<?php
// Harris Christiansen
// Created 2014-3-22

defaultsInclude('assignmentDivisions');

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
viewAssignmentsHome();
viewHTML('</table>');

display('viewFooter');

?>