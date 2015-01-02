<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('membersListRows');
defaultsInclude('editRankFields');

display('viewHeader');
?>

	<header class="major">
		<h2>Members List</h2>
	</header>

	<table>
		<? displayMembersListHead(); ?>
		<? displayMembersList(); ?>
	</table>

<?
display('viewFooter');
?>