<?php
// Harris Christiansen
// Created 10-2-12
// Updated 10-3-12

defaultsInclude('membersListRows');
defaultsInclude('editRankFields');

display('viewHeader');

displayMembersListHead();
displayMembersList();

display('viewFooter');
?>