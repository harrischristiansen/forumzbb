<?php
// Harris Christiansen
// Created 5-15-13
// Updated 5-15-13


// Extend mysqli_query function to specify a table title
	function dbQuery($con, $sql) {
		// Get Table Title
		$tableTitle=session_name();
		$tableTitle="FROM ".$tableTitle."_";
		// Append Table Title
		$sql = str_replace("FROM ",$tableTitle,$sql);
		// Execute Query and Return Result
		return mysqli_query($con, $sql);
	}
?>