<?php
// Harris Christiansen
// Created 10-3-12

function viewBreadcrumbs() {
	$numBreadcrumbs=getNumBreadcrumbs();
	for($i=0;$i<$numBreadcrumbs;$i++) {
		if($i==0) {
			viewHTML(getBreadcrumb($i));
		} else {
			viewHTML(" -> ".getBreadcrumb($i));
		}
	}
}
?>