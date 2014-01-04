<?php
// Harris Christiansen
// Created 2014-1-3

function getPermissionsTable() {
	$sql = "SELECT * FROM permissions ORDER BY category, orderNum";
	$result = dbQuery($sql) or die ("Query failed: getPermissionsTable");
	return $result;
}

?>