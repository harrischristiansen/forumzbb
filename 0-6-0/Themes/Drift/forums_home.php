<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('forumDivisions');

display('viewHeader');
?>

	<header class="major">
		<h2>Forum</h2>
	</header>
	
	<table>
		<? viewForumHome(); ?>
	</table>

<?
display('viewFooter');
?>