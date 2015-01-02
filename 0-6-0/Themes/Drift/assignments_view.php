<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('assignmentDivisions');

display('viewHeader');
?>

	<header class="major">
		<h2>Assignments</h2>
	</header>
	<? viewAssignment(); ?>

<?
display('viewFooter');
?>