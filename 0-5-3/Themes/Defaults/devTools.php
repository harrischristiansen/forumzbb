<?php
// Harris Christiansen
// Created 10-2-12
// Updated 10-2-12

function getPageLoadInfo() {
	global $starttime, $sqlQueries;
	$m_time = explode(" ",microtime());
	$m_time = $m_time[0] + $m_time[1];
	$endtime = $m_time;
	$totaltime = ($endtime - $starttime);
	$totaltime = round($totaltime,7);
	return($sqlQueries." queries, ".$totaltime." seconds.");
}
?>