<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('assignmentDivisions');

display('viewHeader');
?>

<section id="main" class="wrapper style1">
	<header class="major">
		<h2>Assignments</h2>
	</header>
<? viewAssignment(); ?>
</section>

<?
display('viewFooter');
?>