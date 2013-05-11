<?php
// Harris Christiansen
// Created 10-1-12
// Updated 10-8-12

function getNumBreadcrumbs() {
	global $breadcrumbs;
	return count($breadcrumbs);
}

function getBreadcrumb($num) {
	global $breadcrumbs;
	return $breadcrumbs[$num];
}

function addBreadcrumb($newBreadcrumbName, $newBreadcrumbLink) {
	global $breadcrumbs, $siteSettings;
	$newBreadcrumb='<a href="'.$siteSettings['siteURLShort'].$newBreadcrumbLink.'">'.$newBreadcrumbName.'</a>';
	if(!isset($breadcrumbs)) {
		$breadcrumbs=array($newBreadcrumb);
	} else {
		array_push($breadcrumbs, $newBreadcrumb);
	}
}
?>