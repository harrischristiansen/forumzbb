<?php
// Harris Christiansen
// Created 10-26-12
// Updated 10-30-12

function writeSessionData() {
	global $userData;
	$outputText = "";
	$outputText = $outputText."Username: ".$userData['username']."<br>";
	$outputText = $outputText."Account ID: ".$userData['actID']."<br>";
	$outputText = $outputText."Logged In Status: ".$userData['loggedIn']."<br>";
	$outputText = $outputText."Rank ID: ".$userData['rankID']."<br>";
	$outputText = $outputText."Edit Site Settings: ".$userData['permissions']['editSiteSettings']."<br>";
	$outputText = $outputText."Edit Members Rank: ".$userData['permissions']['editMemberRank']."<br>";
	addImportantNotice($outputText);
	display('viewError');
}
?>