<?php
// Harris Christiansen
// Updated 11-3-13


// Report All Errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors','On');
ini_set('session.gc_maxlifetime',36000);

// Start page load timer
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$starttime = $m_time;
// Reset queries counter
$sqlQueries=0;
// Set timezone
date_default_timezone_set('America/Denver');
// Load Session data
session_name("forumzDev");
session_set_cookie_params(36000);
session_start();
// mysqli Connection Data
$mysqliServer = $_ENV['DATABASE_SERVER'];
$mysqliUser = "db166640_forumz";
$mysqliPass = "forumzbb";
$mysqliDatabase = "db166640_forumzDev";
$con = @mysqli_connect($mysqliServer, $mysqliUser, $mysqliPass, $mysqliDatabase) or die ("Site Not Setup");
// Requires And Load Settings
require_once('loadSiteSettings.php');
loadSiteSettings();
require_once($siteSettings['siteVersionAddress'].'Functions/forumz.main.php');
// Get user info
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
$pageName = mysqli_real_escape_string($con, $_GET['page']);
$pageID = mysqli_real_escape_string($con, $_GET['pageID']);
$pageID2 = mysqli_real_escape_string($con, $_GET['pageID2']);
if($pageName=="") $pageName = "home";
$pagePost = $_POST;
// Primary Display Website Call
displayWebsite();
// Close Mysql Connection/Save User Info
mysqli_close($con);
$con="end";
$_SESSION['userData']=$userData;
$_SESSION['lastLoadTime'] = time();
unset($userData);
?>