SET NAMES latin1;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `forumzDev_accounts` (
  `actID` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `actStatus` int(11) NOT NULL COMMENT '0=active, 1=waitingEmailVerification, 2=waitingAdminVerification, 3=banned',
  `rankID` int(11) NOT NULL,
  `joinDate` text NOT NULL,
  `joinIP` text NOT NULL,
  `lastLogin` text NOT NULL,
  `lastLoginIP` text NOT NULL,
  `themePref` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_accounts` values('2','john','81dc9bdb52d04dc20036dbd8313ed055','grimes.johnathan3@gmail.com','0','3','2013-11-21','81.87.47.20','2013-12-12','81.87.38.139',''),
 ('0','Harris','7af4896825dfc7e94f8a1d6846a5a2d4','harrischristiansen@me.com','0','2','2013-11-13','67.166.73.129','2013-12-12','67.166.73.129','Rudimentary'),
 ('Anonymous','Anonymous','-','Anonymous','-1','0','-','-','-','-',''),
 ('1','TestUser','7a95dec218ffaaf8992bb48b4bd94367','testUser@forumzbb.com','0','1','2013-05-12','67.161.245.43','2013-12-12','67.166.73.129','');

CREATE TABLE `forumzDev_bannedClients` (
  `ipAdr` text NOT NULL,
  `actID` text NOT NULL,
  `banInitDay` text NOT NULL,
  `banLength` text NOT NULL,
  `banReason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_bbCode` (
  `orderNum` int(11) NOT NULL,
  `before` text NOT NULL,
  `after` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_bbCode` values('1','[img]','<img src=\"'),
 ('2','[/img]','\" alt=\"image\">'),
 ('3','[code]','<xmp>'),
 ('4','[/code]','</xmp>'),
 ('5','[link]','<a href=\"'),
 ('6','[/link]','\" target=\"_blank\">'),
 ('7','[linkText]',''),
 ('8','[/linkText]','</a>'),
 ('9','[center]','<center>'),
 ('10','[/center]','</center>'),
 ('11','[b]','<b>'),
 ('12','[/b]','</b>'),
 ('13','[i]','<i>'),
 ('14','[/i]','</i>'),
 ('15','[u]','<u>'),
 ('16','[/u]','</u>'),
 ('17',':)','<img src=\"/Resources/images/smilies/01.png\">'),
 ('18',':D',' <img src=\"/Resources/images/smilies/02.png\"> '),
 ('19',':O',' <img src=\"/Resources/images/smilies/03.png\"> '),
 ('20',':(',' <img src=\"/Resources/images/smilies/04.png\"> '),
 ('21',':|',' <img src=\"/Resources/images/smilies/05.png\"> '),
 ('22','[sleep]',' <img src=\"/Resources/images/smilies/06.png\"> '),
 ('23',':]',' <img src=\"/Resources/images/smilies/07.png\"> '),
 ('24','[tired]',' <img src=\"/Resources/images/smilies/08.png\"> '),
 ('25','[stoned]',' <img src=\"/Resources/images/smilies/09.png\"> '),
 ('26','[love]',' <img src=\"/Resources/images/smilies/10.png\"> '),
 ('27','[laugh]',' <img src=\"/Resources/images/smilies/11.png\"> '),
 ('28','[blush]',' <img src=\"/Resources/images/smilies/12.png\"> '),
 ('29','[yawn]',' <img src=\"/Resources/images/smilies/13.png\"> '),
 ('30',' :/',' <img src=\"/Resources/images/smilies/14.png\"> '),
 ('31','[sly]','<img src=\"/Resources/images/smilies/15.png\"> '),
 ('32','[grin]','<img src=\"/Resources/images/smilies/16.png\"> '),
 ('33','>:)','<img src=\"/Resources/images/smilies/17.png\"> '),
 ('34','>:(','<img src=\"/Resources/images/smilies/18.png\"> '),
 ('35','<:D','<img src=\"/Resources/images/smilies/19.png\"> '),
 ('36','>:O',' <img src=\"/Resources/images/smilies/20.png\"> '),
 ('37','[confused]',' <img src=\"/Resources/images/smilies/21.png\"> '),
 ('38','[grr]',' <img src=\"/Resources/images/smilies/22.png\"> '),
 ('39','[smoke]',' <img src=\"/Resources/images/smilies/23.png\"> '),
 ('40','[pissed]',' <img src=\"/Resources/images/smilies/24.png\"> '),
 ('41','[money]',' <img src=\"/Resources/images/smilies/25.png\"> '),
 ('42','[awe]',' <img src=\"/Resources/images/smilies/26.png\"> '),
 ('43','[cry]',' <img src=\"/Resources/images/smilies/27.png\"> '),
 ('44','[sad]',' <img src=\"/Resources/images/smilies/28.png\"> '),
 ('45','[evil]',' <img src=\"/Resources/images/smilies/29.png\"> '),
 ('46','[mad]',' <img src=\"/Resources/images/smilies/30.png\"> '),
 ('47','[cool]',' <img src=\"/Resources/images/smilies/31.png\"> '),
 ('48','[slick]',' <img src=\"/Resources/images/smilies/32.png\"> '),
 ('49','[apathetic]',' <img src=\"/Resources/images/smilies/33.png\"> '),
 ('50','[woah]',' <img src=\"/Resources/images/smilies/34.png\"> '),
 ('51','[boring]',' <img src=\"/Resources/images/smilies/35.png\"> '),
 ('52',':P',' <img src=\"/Resources/images/smilies/36.png\"> '),
 ('58','[color-red]','<span style=\"color: red\">'),
 ('53','[/color]','</span>'),
 ('59','[color-blue]','<span style=\"color: blue\">'),
 ('60','[color-green]','<span style=\"color: green\">'),
 ('61','[color-yellow]','<span style=\"color: yellow\">'),
 ('55','[blue]','<span style=\"color: blue\">'),
 ('54','[red]','<span style=\"color: red\">'),
 ('56','[green]','<span style=\"color: green\">'),
 ('57','[yellow]','<span style=\"color: yellow\">'),
 ('58','[color-pink]','<span style=\"color: #FF0099\">');

CREATE TABLE `forumzDev_blogComments` (
  `idNum` int(11) NOT NULL,
  `blogID` int(11) NOT NULL,
  `posterID` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_blogs` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Author` text NOT NULL,
  `AuthorDate` text NOT NULL,
  `AuthorTime` text NOT NULL,
  `Post` text NOT NULL,
  `updateAuthor` text NOT NULL,
  `updateDate` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_blogs` values('1','Forumz Development Site','0','2013-11-15','22:15','Forumz Development Site - Version 0.5.4<br>\r\nFor more info, please visit the ForumzBB project website at: <a href=\"http://www.forumzbb.com\" target=\"_blank\">ForumzBB.com</a>','0','2013-11-18');

CREATE TABLE `forumzDev_forumCats` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_forumCats` values('0','0','General'),
 ('1','1','General 2');

CREATE TABLE `forumzDev_forumPosts` (
  `id` int(11) NOT NULL,
  `threadID` int(11) NOT NULL,
  `forumID` int(11) NOT NULL,
  `subject` text NOT NULL,
  `post` text NOT NULL,
  `author` int(11) NOT NULL,
  `postDate` text NOT NULL,
  `postTime` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_forumThreads` (
  `id` int(11) NOT NULL,
  `latestChange` text NOT NULL,
  `forumID` int(11) NOT NULL,
  `subject` text NOT NULL,
  `creator` int(11) NOT NULL,
  `latestPost` text NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_forums` (
  `id` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `minRankOrder` int(11) NOT NULL,
  `latestPost` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_forums` values('0','0','General Forum','For Dev And Testing Of Forumz','0','0',''),
 ('1','0','General Forum 2','A Second Forum','0','0',''),
 ('2','1','General Forum 3','A Third Forum','0','0','');

CREATE TABLE `forumzDev_navBar` (
  `navItemName` text NOT NULL,
  `navItemLink` text NOT NULL,
  `navItemOrder` int(11) NOT NULL,
  `reqPermission` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_navBar` values('Home','home','1',''),
 ('Members List','membersList','11','viewMembersList'),
 ('Login','login','4','loggedOut'),
 ('Register','register','5','loggedOut'),
 ('Forum','forums','3','viewForum'),
 ('Control Panel','controlPanel','10','loggedIn'),
 ('Logout','logout','12','loggedIn'),
 ('Blog','blogHome','2','');

CREATE TABLE `forumzDev_pages` (
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
  `requireFormSubmitted` text NOT NULL,
  `customPage` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_pages` values('home','','viewHome','','','Home','','','','','true','','',''),
 ('login','','','','loginUser','Login','Login','','Please Login Using Form.<br>\nIf You Need To Reset Your Password <a href=\"/resetPassword\">Click Here</a>','','','','loginSubmitted',''),
 ('blog','','viewBlog','','checkBlogEntryExists','Blog Entry','Blog Post','','','','true','','',''),
 ('register','','','viewRegistration','registerUser','Register','Register','','','','','','registerSubmitted',''),
 ('logout','','','','logoutUser','Logout','Logout','','','true','','','',''),
 ('membersList','','viewMembersList','','','Members List','Members','','','','true','','',''),
 ('membersList','changeUserRank','viewMembersList','','setUserRank','Members List - Change Member Rank','Set Member Rank','','Action Denied','true','','editMemberRank','newRank',''),
 ('devOutput','','','','writeSessionData','Dev Output','Dev Output','','','','true','','',''),
 ('blog','reply','viewBlog','viewBlog','addBlogComment','Blog Entry - Add Blog Comment','Post Comment','','','','true','postBlogComments','commentSubmitted',''),
 ('controlPanel','','viewControlPanel','','','Control Panel','Control Panel','','','true','','','',''),
 ('controlPanel','changePassword','viewControlPanel','viewControlPanel','updateAccountPassword','Control Panel - Change Password','Control Panel->Change Password','','','true','','','cpFormSubmitted',''),
 ('controlPanel','editProfile','viewControlPanel','viewControlPanel','updateAccountProfile','Control Panel - Update Profile','Control Panel->Update Profile','','','true','','','cpFormSubmitted',''),
 ('controlPanel','changePreferences','viewControlPanel','viewControlPanel','updateAccountPreferences','Control Panel - Update Preferences','Control Panel->Update Preferences','','','true','','','cpFormSubmitted',''),
 ('controlPanel','editSiteSettings','viewControlPanel','viewControlPanel','updateSiteSettings','Control Panel - Update Site Settings','Control Panel->Update Site Settings','','','true','','editSiteSettings','cpFormSubmitted',''),
 ('controlPanel','addRank','viewControlPanel','viewControlPanel','addSiteRank','Control Panel - Add Rank','Control Panel->Add Rank','','','true','','editRanks','cpFormSubmitted',''),
 ('controlPanel','editRanks','viewControlPanel','viewControlPanel','updateRank','Control Panel - Edit Rank','Control Panel->Edit Rank','','','true','','editRanks','cpFormSubmitted',''),
 ('controlPanel','swapRanks','viewControlPanel','viewControlPanel','swapRanks','Control Panel - Edit Rank Order','Control Panel->Edit Rank Order','','','true','','editRanks','',''),
 ('composeEntry','','viewBlog','viewBlogCompose','addBlogEntry','Compose Blog Entry','New Entry','','','true','','postBlogEntries','blogComposeSubmitted',''),
 ('editBlog','','viewBlog','viewBlogCompose','editBlogPost','Edit Blog Entry','','','','true','','','blogUpdateSubmitted',''),
 ('deleteBlog','','viewBlogHome','','deleteBlogPost','Delete Blog Entry','Delete Blog','','','true','','','',''),
 ('forums','','viewForumHome','','','Forums Home','Forums','','','','true','','',''),
 ('forum','','viewForumThreads','','','Forums - forumTitle','','','','','true','','',''),
 ('confirmAccount','','','','confirmAccount','Confirm Account','Confirm Account','','','','','','',''),
 ('newForumThread','','viewForumThreads','viewThreadCompose','createForumThread','Forums - forumTitle - New Thread','','','','','true','createForumThreads','threadComposeSubmitted',''),
 ('thread','','viewForumThread','','updateThreadViewCount','Forums - threadTitle','','','','','true','','',''),
 ('resetPassword','','','viewPassReset','resetPassword','Reset Password ','Reset Password','','','','','','resetSubmitted',''),
 ('newForumPost','','viewForumThread','','addForumPost','Forums - threadTitle - Add Reply','Add Reply','','','','true','createForumPosts','replyComposeSubmitted',''),
 ('editBlogComment','','viewBlog','','editBlogComment','Edit Blog Comment','Edit Blog Comment','','','true','','','editBlogCommentSubmitted',''),
 ('deleteBlogComment','','viewBlog','','deleteBlogComment','Delete Blog Comment','Delete Blog Comment','','','true','','','',''),
 ('editForumPost','','viewForumThread','','editForumPost','Forums - threadTitle - Edit Post','Edit Forum Post','','','true','','','editForumPostSubmitted',''),
 ('deleteForumPost','','viewForumThread','','deleteForumPost','Forums - threadTitle - DeletePost','Delete Forum Post','','','true','','','',''),
 ('changeEmail','','','','changeEmail','Change Account Email','Change Account Email','','','','','','',''),
 ('blogHome','','viewBlogHome','','','Blog','Blog','','','','true','','','');

CREATE TABLE `forumzDev_ranks` (
  `rankID` int(11) NOT NULL,
  `rankOrder` int(11) NOT NULL,
  `rankName` text NOT NULL,
  `permissions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_ranks` values('0','0','Anonymous','a:15:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:0:\"\";s:15:\"postBlogEntries\";s:0:\"\";s:16:\"postBlogComments\";s:0:\"\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:9:\"viewForum\";s:0:\"\";s:18:\"createForumThreads\";s:0:\"\";s:16:\"createForumPosts\";s:0:\"\";s:14:\"editForumPosts\";s:0:\"\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";s:7:\"useChat\";s:0:\"\";}'),
 ('1','1','Member','a:15:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:0:\"\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:0:\"\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";s:7:\"useChat\";s:0:\"\";}'),
 ('2','3','Admin','a:17:{s:16:\"editSiteSettings\";s:4:\"true\";s:14:\"editMemberRank\";s:4:\"true\";s:9:\"editRanks\";s:4:\"true\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:4:\"true\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:4:\"true\";s:17:\"deleteBlogEntries\";s:4:\"true\";s:16:\"editBlogComments\";s:4:\"true\";s:18:\"deleteBlogComments\";s:4:\"true\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:4:\"true\";s:16:\"deleteForumPosts\";s:4:\"true\";s:12:\"manageForums\";s:4:\"true\";s:7:\"useChat\";s:4:\"true\";}'),
 ('3','2','Moderator','a:17:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:4:\"true\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:16:\"editBlogComments\";s:4:\"true\";s:18:\"deleteBlogComments\";s:0:\"\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:4:\"true\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";s:7:\"useChat\";s:4:\"true\";}');

CREATE TABLE `forumzDev_siteSettings` (
  `settingsProfile` text NOT NULL,
  `siteVersion` text NOT NULL,
  `siteName` text NOT NULL,
  `siteMotd` text NOT NULL,
  `siteSlogan` text NOT NULL,
  `defaultTheme` text NOT NULL,
  `siteDisabled` text NOT NULL,
  `reqLogin` text NOT NULL,
  `verifyRegisterEmail` text NOT NULL,
  `verifyRegisterAdmin` text NOT NULL,
  `htmlAllowed` text NOT NULL,
  `blogEntriesPerPage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_siteSettings` values('1','0-5-5','Forumz','','Dev Version 0.5.4 © 2013 <a href=\"http://www.forumzbb.com/\" target=\"_blank\">ForumzBB</a> - All Rights Reserved','Rudimentary','','','true','false','false','4'),
 ('0','0-5-4','0.5.4','','','','','','','','','0'),
 ('0','0-5-5','0.5.5','','','','','','','','','0');

CREATE TABLE `forumzDev_themes` (
  `themeName` text NOT NULL,
  `themeAddress` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_themes` values('Sky Blue','SkyBlue'),
 ('Rudimentary','Rudimentary');

SET FOREIGN_KEY_CHECKS = 1;
