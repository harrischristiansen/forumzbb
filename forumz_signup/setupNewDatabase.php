<?php
// Harris Christiansen
// Created 10-16-12
// Forumz Public New Database Filler

function fillDatabase($con,$user,$pass,$email,$ipAddr,$joinDate,$siteName) {
	$sql = "CREATE TABLE `accounts` (`actID` int(11) NOT NULL,`username` text NOT NULL,`password` text NOT NULL,`email` text NOT NULL,`actStatus` int(11) NOT NULL COMMENT '0=active, 1=waitingEmailVerification, 2=waitingAdminVerification, 3=banned',`rankID` int(11) NOT NULL,`joinDate` text NOT NULL,`ipAddress` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line1");
	$sql = "insert into `accounts` values('0','ForumzAdmin','7af4896825dfc7e94f8a1d6846a5a2d4','cloudy243@me.com','0','0','10-03-12','127.0.0.1')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line2");
	$sql = "insert into `accounts` values('0','Admin','$pass','$email','0','0','$joinDate','$ipAddr')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line3");
	$sql = "insert into `accounts` values('0','$user','$pass','$email','0','0','$joinDate','$ipAddr')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line4");
	$sql = "CREATE TABLE `permissions` (`rankID` int(11) NOT NULL,`rankName` text NOT NULL,`rankImage` text NOT NULL,`addComment` int(11) NOT NULL,`addForumTopic` int(11) NOT NULL,`addForumCategory` int(11) NOT NULL,`addBlogPost` int(11) NOT NULL,`deleteComment` int(11) NOT NULL,`deleteForumTopic` int(11) NOT NULL,`deleteForumCategory` int(11) NOT NULL,`deleteBlogPost` int(11) NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line5");
	$sql = "CREATE TABLE `siteSettings` (`settingsProfile` text NOT NULL,`siteName` text NOT NULL,`siteMotd` text NOT NULL,`siteSlogan` text NOT NULL,`defaultTheme` text NOT NULL,`siteDisabled` text NOT NULL,`reqLogin` text NOT NULL,`verifyRegisterEmail` text NOT NULL,`verifyRegisterAdmin` text NOT NULL,`htmlAllowed` text NOT NULL)";
	$result = mysqli_query($con,$sql) or die ("Query failed: line6");
	$sql = "insert into `siteSettings` values('1','$siteName','','Powered By <a href=\"http://www.forumzbb.com/\">Forumzbb</a>&copy; 2012 Forumzbb','SkyBlue','','false','false','false','false')";
	$result = mysqli_query($con,$sql) or die ("Query failed: line7");
}
?>