<?php
// Harris Christiansen
// Created 10-2-12

defaultsInclude('membersListRows');
defaultsInclude('editRankFields');

display('viewHeader');

viewHTML('<table class="FullWidthTable">');
displayMembersListHead();
displayMembersList();
viewHTML('</table>');

display('viewFooter');
?>