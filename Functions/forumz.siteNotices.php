<?php
// Harris Christiansen
// Created 10-3-12
// Updated 5-22-13

// Collection and Display of Site Notices

//// Failure Notices

function addFailureNotice($msg) {
	global $notices_failures;
	if(!isset($notices_failures)) {
		$notices_failures=array($msg);
	} else {
		array_push($notices_failures, $msg);
	}
}

function getNumFailureNotices() {
	global $notices_failures;
	return count($notices_failures);
}

function getFailureNotice($num) {
	global $notices_failures;
	return $notices_failures[$num];
}

function displayFailures() {
	$numNotices=getNumFailureNotices();
	for($i=0;$i<$numNotices;$i++) {
		viewFailure(getFailureNotice($i));
	}
}

//// Success Notices

function addSuccessNotice($msg) {
	global $notices_successes;
	if(!isset($notices_successes)) {
		$notices_successes=array($msg);
	} else {
		array_push($notices_successes, $msg);
	}
}

function getNumSuccessNotices() {
	global $notices_successes;
	return count($notices_successes);
}

function getSuccessNotice($num) {
	global $notices_successes;
	return $notices_successes[$num];
}

function displaySuccesses() {
	$numNotices=getNumSuccessNotices();
	for($i=0;$i<$numNotices;$i++) {
		viewSuccess(getSuccessNotice($i));
	}
}

//// Default Notices

function addNotice($msg) {
	global $notices;
	if(!isset($notices)) {
		$notices=array($msg);
	} else {
		array_push($notices, $msg);
	}
}

function getNumNotices() {
	global $notices;
	return count($notices);
}

function getNotice($num) {
	global $notices;
	return $notices[$num];
}

function displayNotices() {
	$numNotices=getNumNotices();
	for($i=0;$i<$numNotices;$i++) {
		viewNotice(getNotice($i));
	}
}

//// Important Notices

function addImportantNotice($msg) {
	global $notices_important;
	if(!isset($notices_important)) {
		$notices_important=array($msg);
	} else {
		array_push($notices_important, $msg);
	}
}

function getNumImportantNotices() {
	global $notices_important;
	return count($notices_important);
}

function getImportantNotice($num) {
	global $notices_important;
	return $notices_important[$num];
}

function displayImportantNotices() {
	$numNotices=getNumImportantNotices();
	for($i=0;$i<$numNotices;$i++) {
		viewImportantNotice(getImportantNotice($i));
	}
}

//// Display All Notices

function displayAllNotices() {
	displayNotices();
	displaySuccesses();
	displayFailures();
	displayImportantNotices();
}

?>