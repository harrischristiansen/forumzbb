<?php
// Harris Christiansen
// Created 2015-01-01
// Theme: Drift

defaultsInclude('forumDivisions');

display('viewHeader');
?>

<section id="main" class="wrapper style1">
	<header class="major">
		<h2>Forum</h2>
	</header>
	
	<table>
		<? viewForumHome(); ?>
	</table>
</section>

<?
display('viewFooter');
?>