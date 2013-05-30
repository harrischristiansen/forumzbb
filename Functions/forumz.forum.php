<?php
// Harris Christiansen
// Created 5-29-13
// Updated 5-29-13



// General Functions
function getForumCategories() {
	$sql = "SELECT * FROM forumCats";
	$result = dbQuery($sql) or die ("Query failed: getForumCategories");
	return $result;
}

function getForumsByCatID($catID) {
	$sql = "SELECT * FROM forums WHERE catID='$catID' ORDER BY title";
	$result = dbQuery($sql) or die ("Query failed: getForumsByCatID");
	return $result;
}

function getNumForums() {
	$sql = "SELECT * FROM forums";
	$result = dbQuery($sql) or die ("Query failed: getNumForums");
	return mysqli_num_rows($result);
}
?>