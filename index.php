<?php
// Harris Christiansen
// Updated 5-10-12


// Report All Errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors','On');

// Start page load timer
global $starttime;
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$starttime = $m_time;
// Reset queries counter
global $sqlQueries;
$sqlQueries=0;
// Set timezone
date_default_timezone_set('America/Denver');
// Load Session data
session_name("forumzSingle");
session_start();
// mysqli Connection Data 
$mysqliServer = "localhost";
$mysqliUser = "forumz";
$mysqliPass = "forumzbb";
$mysqliDatabase = "forumz";
global $con;
$con = @mysqli_connect($mysqliServer, $mysqliUser, $mysqliPass, $mysqliDatabase) or die ("Site Not Setup");
// Requires
require_once('Functions/forumz.main.php');
// Get user info
global $userData;
$userData=$_SESSION['userData'];
// Set default rank
if($userData['rankID']=="") {
	$userData['rankID']="0";
	$userData['loggedIn']=false;
}
if($userData['siteTheme']=="") {
	$userData['siteTheme']="SkyBlue";
}
// Get Page
global $pageName, $pageID, $pageID2, $pagePost;
$pageName = mysqli_real_escape_string($con,$_GET['page']);
$pageID = mysqli_real_escape_string($con,$_GET['pageID']);
$pageID2 = mysqli_real_escape_string($con,$_GET['pageID2']);
if($pageName=="") $pageName = "home";
if($pageID=="") $pageID = "none";
if($pageID2=="") $pageID2 = "none";
$pagePost = $_POST;
// Display Website // Starts Everything Up
displayWebsite();
// Close Mysql Connection/Save User Info
mysqli_close($con);
$con="end";
$_SESSION['userData']=$userData;
?>