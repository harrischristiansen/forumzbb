<?php
// Harris Christiansen
// Created 5-15-13
// Updated 5-16-13


// Extend mysqli_query function to specify a table title
	function dbQuery($sql) {
		global $con, $sqlQueries;
		// Get Table Title
		$tableTitle=session_name();
		$tableTitle_from="FROM ".$tableTitle."_";
		$tableTitle_upd="UPDATE ".$tableTitle."_";
		$tableTitle_inst="INSERT INTO ".$tableTitle."_";
		// Append Table Title
		$sql = str_replace("FROM ",$tableTitle_from,$sql);
		$sql = str_replace("UPDATE ",$tableTitle_upd,$sql);
		$sql = str_replace("INSERT INTO ",$tableTitle_inst,$sql);
		// Execute Query and Return Result
		$sqlQueries++;
		return mysqli_query($con, $sql);
	}
?>