<?
// Harris Christiansen
// Created 2014-3-22

function viewAssignmentsHome() {
	global $siteSettings;
	$assignments=getAssignments();
	$rowID=0;
	displayAssignmentsHead();
	while($assignment = mysqli_fetch_array($assignments)) {
		displayAssignmentsLine();
		$rowID++;
	}
}

function getAssignments() {
	$sql = "SELECT * FROM assignments ORDER BY createDate DESC";
	$result = dbQuery($sql) or die ("Query failed: getAssignments");
	return $result;
}

function getNumAssignments() {
	$sql = "SELECT * FROM assignments";
	$result = dbQuery($sql) or die ("Query failed: getNumAssignments");
	return mysqli_num_rows($result);
}

?>