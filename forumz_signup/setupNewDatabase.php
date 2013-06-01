<?php
// Harris Christiansen
// Created 10-16-12
// Updated 6-1-13
// Forumz Public New Database Filler
// For 0.5.3 Release

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
	$sql = "insert into `".$tableTitle."_accounts` values('Anonymous','Anonymous','-','Anonymous','-1','0','-','-','-','-')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line5");
	
	// Site Settings Table
	$sql = "CREATE TABLE `".$tableTitle."_siteSettings` (`settingsProfile` text NOT NULL,`siteVersion` text NOT NULL,`siteName` text NOT NULL,`siteMotd` text NOT NULL,`siteSlogan` text NOT NULL,`defaultTheme` text NOT NULL,`siteDisabled` text NOT NULL,`reqLogin` text NOT NULL,`verifyRegisterEmail` text NOT NULL,`verifyRegisterAdmin` text NOT NULL,`htmlAllowed` text NOT NULL,`blogEntriesPerPage` int(11) NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line6");
	$sql = "insert into `".$tableTitle."_siteSettings` values('1','0-5-3','$siteName','','Powered By <a href=\"http://www.forumzbb.com/\">Forumzbb</a>&copy; 2013 Forumzbb','SkyBlue','','false','false','false','false','4')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line7");
	
	// Blog Comments Table
	$sql = "CREATE TABLE `".$tableTitle."_blogComments` (`idNum` int(11) NOT NULL,`blogID` int(11) NOT NULL,`posterID` text NOT NULL,`date` text NOT NULL,`time` text NOT NULL,`comment` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line8");
	
	// Blogs Table
	$sql = "CREATE TABLE `".$tableTitle."_blogs` (`ID` int(11) NOT NULL,`Title` text NOT NULL,`Author` text NOT NULL,`AuthorDate` text NOT NULL,`AuthorTime` text NOT NULL,`Post` text NOT NULL,`updateAuthor` text NOT NULL,`updateDate` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line9");
	
	// Pages Table
	$sql = "CREATE TABLE `".$tableTitle."_pages` (
  `pageURL` text NOT NULL,
  `idDependant` text NOT NULL,
  `displayFile` text NOT NULL,
  `falseDisplayFile` text NOT NULL,
  `functionCall` text NOT NULL,
  `pageName` text NOT NULL,
  `breadcrumbTitle` text NOT NULL,
  `trueMsg` text NOT NULL,
  `falseMsg` text NOT NULL,
  `requireLogin` text NOT NULL,
  `siteRequireLoginApplies` text NOT NULL,
  `requirePermission` text NOT NULL,
  `requireFormSubmitted` text NOT NULL
)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line10");
	$sql = "insert into `".$tableTitle."_pages` values('home','','viewBlogHome','','','Home','','','','','true','',''),
 ('login','','','','loginUser','Login','Login','','Please Login Above','','','','loginSubmitted'),
 ('blog','','viewBlog','','checkBlogEntryExists','Blog Entry','Blog Post','','','','true','',''),
 ('register','','','viewRegistration','registerUser','Register','Register','','','','','','registerSubmitted'),
 ('logout','','','','logoutUser','Logout','Logout','','','true','','',''),
 ('membersList','','viewMembersList','','','Members List','Members','','','','true','',''),
 ('membersList','changeUserRank','viewMembersList','','setUserRank','Members List - Change Member Rank','Set Member Rank','','Action Denied','true','','editMemberRank','newRank'),
 ('blog','reply','viewBlog','viewBlog','addBlogComment','Blog Entry - Add Blog Comment','Post Comment','','','','true','postBlogComments','commentSubmitted'),
 ('controlPanel','','viewControlPanel','','','Control Panel','Control Panel','','','true','','',''),
 ('controlPanel','changePassword','viewControlPanel','viewControlPanel','updateAccountPassword','Control Panel - Change Password','Control Panel Change Password','','','true','','','cpFormSubmitted'),
 ('controlPanel','editProfile','viewControlPanel','viewControlPanel','updateAccountProfile','Control Panel - Update Profile','Control Panel Update Profile','','','true','','','cpFormSubmitted'),
 ('controlPanel','changePreferences','viewControlPanel','viewControlPanel','','Control Panel - Update Preferences','Control Panel Update Preferences','','','true','','','cpFormSubmitted'),
 ('controlPanel','editSiteSettings','viewControlPanel','viewControlPanel','updateSiteSettings','Control Panel - Update Site Settings','Control Panel Update Site Settings','','','true','','editSiteSettings','cpFormSubmitted'),
 ('controlPanel','addRank','viewControlPanel','viewControlPanel','addSiteRank','Control Panel - Add Rank','Control Panel Add Rank','','','true','','editRanks','cpFormSubmitted'),
 ('controlPanel','editRanks','viewControlPanel','viewControlPanel','updateRank','Control Panel - Edit Rank','Control Panel Edit Rank','','','true','','editRanks','cpFormSubmitted'),
 ('controlPanel','swapRanks','viewControlPanel','viewControlPanel','swapRanks','Control Panel - Edit Rank Order','Control Panel Edit Rank Order','','','true','','editRanks',''),
 ('composeEntry','','viewBlog','viewBlogCompose','addBlogEntry','Compose Blog Entry','New Entry','','','true','','postBlogEntries','blogComposeSubmitted'),
 ('editBlog','','viewBlog','viewBlogCompose','editBlogPost','Edit Blog Entry','Edit Blog','','','true','','','blogUpdateSubmitted'),
 ('deleteBlog','','viewBlogHome','','deleteBlogPost','Delete Blog Entry','Delete Blog','','','true','','','')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line11");
	
	// Ranks Table
	$sql = "CREATE TABLE `".$tableTitle."_ranks` (
  `rankID` int(11) NOT NULL,
  `rankOrder` int(11) NOT NULL,
  `rankName` text NOT NULL,
  `editSiteSettings` text NOT NULL,
  `editMemberRank` text NOT NULL,
  `editRanks` text NOT NULL,
  `postBlogEntries` text NOT NULL,
  `postBlogComments` text NOT NULL,
  `editBlogEntries` text NOT NULL,
  `deleteBlogEntries` text NOT NULL
)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line12");
	
	$sql = "insert into `".$tableTitle."_ranks` values('0','0','Anonymous','','','','','','',''),
 ('1','1','Member','','','','','true','',''),
 ('2','3','Admin','true','true','true','true','true','true','true'),
 ('3','2','Writter','','','','true','true','','')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line13");
	
	// Forum Categories Table
	$sql = "CREATE TABLE `".$tableTitle."_forumCats` (`id` int(11) NOT NULL,`orderID` int(11) NOT NULL,`title` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line14");
	
	// Forum Posts Table
	$sql = "CREATE TABLE `".$tableTitle."_forumPosts` (
	  `id` int(11) NOT NULL,
	  `threadID` int(11) NOT NULL,
	  `forumID` int(11) NOT NULL,
	  `subject` text NOT NULL,
	  `post` text NOT NULL,
	  `author` int(11) NOT NULL,
	  `postDate` text NOT NULL,
	  `postTIme` text NOT NULL
	)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line15");
	
	// Forum Threads Table
	$sql = "CREATE TABLE `".$tableTitle."_forumThreads` (
	  `id` int(11) NOT NULL,
	  `orderID` int(11) NOT NULL,
	  `forumID` int(11) NOT NULL,
	  `subject` text NOT NULL,
	  `creator` int(11) NOT NULL,
	  `latestPost` text NOT NULL,
	  `views` int(11) NOT NULL
	)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line16");
	
	// Forums Table
	$sql = "CREATE TABLE `".$tableTitle."_forums` (
	  `id` int(11) NOT NULL,
	  `catID` int(11) NOT NULL,
	  `title` text NOT NULL,
	  `desc` text NOT NULL,
	  `type` int(11) NOT NULL,
	  `minRankOrder` int(11) NOT NULL,
	  `latestPost` text NOT NULL
	)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line17");
	
	// NavBar Table
	$sql = "CREATE TABLE `".$tableTitle."_navBar` (
	  `navItemName` text NOT NULL,
	  `navItemLink` text NOT NULL,
	  `navItemOrder` text NOT NULL,
	  `navItemDisplay` text NOT NULL
	)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line18");
	
	$sql = "insert into `".$tableTitle."_navBar` values('Home','home','1','loggedOut'),
	('Members List','membersList','2','loggedOut'),
	('Login','login','3','loggedOut'),
	('Register','register','4','loggedOut'),
	('Home','home','1','loggedIn'),
	('Members List','membersList','3','loggedIn'),
	('Control Panel','controlPanel','4','loggedIn'),
	('Logout','logout','5','loggedIn')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line19");

	// Banned Clients Table
	$sql = "CREATE TABLE `".$tableTitle."_bannedClients` (
  		`ipAdr` text NOT NULL,
  		`actID` text NOT NULL,
  		`banInitDay` text NOT NULL,
  		`banLength` text NOT NULL,
  		`banReason` text NOT NULL
	)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line20");

}
?>