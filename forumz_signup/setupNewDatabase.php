<?php
// Harris Christiansen
// Created 10-16-12
// Updated 5-19-13
// Forumz Public New Database Filler
// For 0.5.2 Release

function fillDatabase($con,$tableTitle,$user,$pass,$email,$ipAddr,$joinDate,$siteName) {
	// Accounts Table
	$sql = "CREATE TABLE `".$tableTitle."_accounts` (`actID` text NOT NULL,`username` text NOT NULL,`password` text NOT NULL,`email` text NOT NULL,`actStatus` int(11) NOT NULL COMMENT '0=active, 1=waitingEmailVerification, 2=waitingAdminVerification, 3=banned',`rankID` int(11) NOT NULL,`joinDate` text NOT NULL,`joinIP` text NOT NULL,`lastLogin` text NOT NULL,`lastLoginIP` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line1");
	$sql = "insert into `".$tableTitle."_accounts` values('0','ForumzAdmin','7af4896825dfc7e94f8a1d6846a5a2d4','cloudy243@me.com','0','2','$joinDate','$ipAddr','','')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line2");
	$sql = "insert into `".$tableTitle."_accounts` values('1','Admin','$pass','$email','0','2','$joinDate','$ipAddr','','')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line3");
	$sql = "insert into `".$tableTitle."_accounts` values('2','$user','$pass','$email','0','2','$joinDate','$ipAddr','','')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line4");
	$sql = "insert into `".$tableTitle."_accounts` values('Anonymous','Anonymous','-','Anonymous','0','0','-','-','-','-')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line5");
	
	// Site Settings Table
	$sql = "CREATE TABLE `".$tableTitle."_siteSettings` (`settingsProfile` text NOT NULL,`siteName` text NOT NULL,`siteMotd` text NOT NULL,`siteSlogan` text NOT NULL,`defaultTheme` text NOT NULL,`siteDisabled` text NOT NULL,`reqLogin` text NOT NULL,`verifyRegisterEmail` text NOT NULL,`verifyRegisterAdmin` text NOT NULL,`htmlAllowed` text NOT NULL,`blogEntriesPerPage` int(11) NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line6");
	$sql = "insert into `".$tableTitle."_siteSettings` values('1','$siteName','','Powered By <a href=\"http://www.forumzbb.com/\">Forumzbb</a>&copy; 2013 Forumzbb','SkyBlue','','false','false','false','false','4')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line7");
	
	// Blog Comments Table
	$sql = "CREATE TABLE `".$tableTitle."_blogComments` (`idNum` int(11) NOT NULL,`blogID` int(11) NOT NULL,`posterID` text NOT NULL,`date` text NOT NULL,`time` text NOT NULL,`comment` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line8");
	
	// Blogs Table
	$sql = "CREATE TABLE `".$tableTitle."_blogs` (`ID` int(11) NOT NULL,`Title` text NOT NULL,`Author` text NOT NULL,`AuthorDate` text NOT NULL,`AuthorTime` text NOT NULL,`Post` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line9");
	
	// Pages Table
	$sql = "CREATE TABLE `".$tableTitle."_pages` (`pageURL` text NOT NULL,`idDependant` text NOT NULL,`displayFile` text NOT NULL,`falseDisplayFile` text NOT NULL,`functionCall` text NOT NULL,`pageName` text NOT NULL,`breadcrumbTitle` text NOT NULL,`trueMsg` text NOT NULL,`falseMsg` text NOT NULL,`requireLogin` text NOT NULL,`siteRequireLoginApplies` text NOT NULL,`requirePermission` text NOT NULL,`requireFormSubmitted` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line10");
	$sql = "insert into `".$tableTitle."_pages` values('home','','viewHome','','','Home','','','','','true','',''),
	('login','','viewHome','','loginUser','Login','Login','You Are Logged In','Please Login Above','','','','loginSubmitted'),
	('blog','','viewBlog','','checkBlogEntryExists','Blog Post','Blog Post','','','','true','',''),
	('register','','','viewRegistration','registerUser','Register','Register','','','','','','registerSubmitted'),
	('logout','','viewHome','','logoutUser','Logout','Logout','','','','','',''),
	('membersList','','viewMembersList','','','Members List','Members','','','','','',''),
	('membersList','changeUserRank','','','setUserRank','','Set Member Rank','','Action Denied','true','','editMemberRank','newRank'),
	('devOutput','','','','writeSessionData','Dev Output','Dev Output','','','','','',''),
	('blog','reply','viewBlog','viewBlog','addBlogComment','','Post Comment','','','','true','postBlogComments','commentSubmitted'),
	('controlPanel','','viewControlPanel','','','Control Panel','Control Panel','Select An Item On The Left','','true','','',''),
	('controlPanel','changePassword','viewControlPanel','viewControlPanel','updateAccountPassword','Control Panel Change Password','Control Panel Change Password','','','true','','','cpFormSubmitted'),
	('controlPanel','editProfile','viewControlPanel','viewControlPanel','updateAccountProfile','Control Panel Update Profile','Control Panel Update Profile','','','true','','','cpFormSubmitted'),
	('controlPanel','changePreferences','viewControlPanel','viewControlPanel','','Control Panel Update Preferences','Control Panel Update Preferences','','','true','','','cpFormSubmitted'),
	('controlPanel','editSiteSettings','viewControlPanel','viewControlPanel','updateSiteSettings','Control Panel Update Site Settings','Control Panel Update Site Settings','','','true','','editSiteSettings','cpFormSubmitted'),
	('controlPanel','addRank','viewControlPanel','viewControlPanel','addSiteRank','Control Panel Add Rank','Control Panel Add Rank','','','true','','editRanks','cpFormSubmitted'),
	('controlPanel','editRanks','viewControlPanel','viewControlPanel','updateRank','Control Panel Edit Rank','Control Panel Edit Rank','','','true','','editRanks','cpFormSubmitted'),
	('composeEntry','','viewBlog','viewBlogCompose','addBlogEntry','Compose Blog Entry','New Entry','','','true','','postBlogEntries','blogComposeSubmitted');";
	$result = mysqli_query($con,$sql) or die ("Query failed: line11");
	
	// Ranks Table
	$sql = "CREATE TABLE `".$tableTitle."_ranks` (`rankID` int(11) NOT NULL,`rankOrder` int(11) NOT NULL,`rankName` text NOT NULL,`editSiteSettings` text NOT NULL,`editMemberRank` text NOT NULL,`editRanks` text NOT NULL,`postBlogEntries` text NOT NULL,`postBlogComments` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line12");
	$sql = "insert into `".$tableTitle."_ranks` values('0','0','Anonymous','false','false','false','false','false'),
	('1','1','Member','','','','','true'),
	('2','1000','Admin','true','true','true','true','true'),
	('3','3','Level 2 Member','false','false','false','false','true');";
	$result = mysqli_query($con,$sql) or die ("Query failed: line13");
}
?>