<?php
// Harris Christiansen
// Created 5-29-13

function displayNavItem($link, $title, $rightItem) {
	if($rightItem) {
		viewHTML('<li class="navItemRight"><a href="'.$link.'">'.$title.'</a></li>');
	} else {
		viewHTML('<li class="navItem"><a href="'.$link.'">'.$title.'</a></li>');
	}
}
?>