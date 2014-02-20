SET NAMES latin1;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `forumzDev_accounts` (
  `actID` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `actFlags` text NOT NULL COMMENT 'active/banned, emailConfirmed, adminConfirmed, renameFlagged',
  `rankID` int(11) NOT NULL,
  `joinDate` text NOT NULL,
  `joinIP` text NOT NULL,
  `lastLogin` text NOT NULL,
  `lastLoginIP` text NOT NULL,
  `themePref` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_accounts` values('0','Harris','7af4896825dfc7e94f8a1d6846a5a2d4','harrischristiansen@mac.com','a:4:{s:6:\"status\";s:1:\"1\";s:14:\"emailConfirmed\";s:1:\"1\";s:14:\"adminConfirmed\";s:1:\"1\";s:10:\"userRename\";s:1:\"0\";}','2','2013-11-13','67.166.73.129','2014-02-19','67.166.73.129','Rudimentary'),
 ('Anonymous','UnregisteredUser','-','Anonymous','','0','-','-','-','-',''),
 ('1','TestUser','7a95dec218ffaaf8992bb48b4bd94367','testUser@forumzbb.com','a:4:{s:6:\"status\";s:1:\"1\";s:14:\"emailConfirmed\";s:1:\"1\";s:14:\"adminConfirmed\";s:1:\"1\";s:10:\"userRename\";s:1:\"0\";}','1','2013-05-12','67.161.245.43','2014-02-19','205.124.117.23','');

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
  `after` text NOT NULL,
  `useOption` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_bbCode` values('1','img','<img src=\"{param}\" alt=\"image\">',''),
 ('2','code','<code>{param}</code>',''),
 ('3','pre','<pre>{param}</pre>',''),
 ('5','li','<li>{param}</li>',''),
 ('6','center','<p style=\"text-align: center;\">{param}</p>',''),
 ('4','b','<b>{param}</b>',''),
 ('7','i','<i>{param}</i>',''),
 ('8','u','<u>{param}</u>',''),
 ('9','s','<strike>{param}</strike>',''),
 ('10','url','<a href=\"{option}\" target=\"_blank\">{param}</a>','true'),
 ('11','ul','<ul>{param}</ul>',''),
 ('12','ol','<ol>{param}</ol>',''),
 ('13','td','<td>{param}</td>',''),
 ('14','sub','<sub>{param}</sub>',''),
 ('15','sup','<sup>{param}</sup>',''),
 ('16','color','<span style=\"color: {option};\">{param}</span>','true'),
 ('17','font','<span style=\"font-family: {option};\">{param}</span>','true'),
 ('18','size','<span style=\"text-size: {option};\">{param}</span>','true'),
 ('19','hr','<hr>',''),
 ('20','email','<a href=\"mailto:{option}\">{param}</a>','true'),
 ('21','table','<table>{param}</table>',''),
 ('22','tr','<tr>{param}</tr>',''),
 ('23','video','<video width=\"320\" height=\"240\" controls><source src=\"{param}\" type=\"video/mp4\">',''),
 ('24','left','<p style=\"text-align: left;\">{param}</p>',''),
 ('25','right','<p style=\"text-align: right;\">{param}</p>','');

CREATE TABLE `forumzDev_blogComments` (
  `idNum` int(11) NOT NULL,
  `blogID` int(11) NOT NULL,
  `posterID` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `comment` text NOT NULL,
  `comment_bb` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_blogs` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Author` text NOT NULL,
  `AuthorDate` text NOT NULL,
  `AuthorTime` text NOT NULL,
  `Post` text NOT NULL,
  `Post_bb` text NOT NULL,
  `updateAuthor` text NOT NULL,
  `updateDate` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_blogs` values('1','Forumz Development Version 0.5.5','0','2014-02-19','22:02:21','Forumz Development Site - Version 0.5.5<br>\r\n<br>\r\nFor more information on the ForumzBB project please visit <a href=\"http://www.forumzbb.com\" target=\"_blank\">forumzbb.com</a>.<br>\r\n<br>\r\nThe beta (latest version under testing) may be found at: <a href=\"http://beta.forumzbb.com\" target=\"_blank\">beta.forumzbb.com</a>.<br>\r\n<br>\r\nPublic Version will be released March 23, 2014.','Forumz Development Site - Version 0.5.5\r\n\r\nFor more information on the ForumzBB project please visit [url=http://www.forumzbb.com]forumzbb.com[/url].\r\n\r\nThe beta (latest version under testing) may be found at: [url=http://beta.forumzbb.com]beta.forumzbb.com[/url].\r\n\r\nPublic Version will be released March 23, 2014.','0','2014-02-19');

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
  `postTime` text NOT NULL,
  `post_bb` text NOT NULL
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
 ('Register','register','4','loggedOut'),
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
 ('register','','','viewRegistration','registerUser','Register','Register','','','','','loggedOut','registerSubmitted',''),
 ('logout','','','','logoutUser','Logout','Logout','','','true','','loggedIn','',''),
 ('membersList','','viewMembersList','','','Members List','Members','','','','true','viewMembersList','',''),
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
 ('forums','','viewForumHome','','','Forums Home','Forums','','','','true','viewForum','',''),
 ('forum','','viewForumThreads','','','Forums - forumTitle','','','','','true','viewForum','',''),
 ('confirmAccount','','','','confirmAccount','Confirm Account','Confirm Account','','','','','','',''),
 ('newForumThread','','viewForumThreads','viewThreadCompose','createForumThread','Forums - forumTitle - New Thread','','','','','true','createForumThreads','threadComposeSubmitted',''),
 ('thread','','viewForumThread','','updateThreadViewCount','Forums - threadTitle','','','','','true','viewForum','',''),
 ('resetPassword','','','viewPassReset','resetPassword','Reset Password ','Reset Password','','','','','','resetSubmitted',''),
 ('newForumPost','','viewForumThread','','addForumPost','Forums - threadTitle - Add Reply','Add Reply','','','','true','createForumPosts','replyComposeSubmitted',''),
 ('editBlogComment','','viewBlog','','editBlogComment','Edit Blog Comment','Edit Blog Comment','','','true','','','editBlogCommentSubmitted',''),
 ('deleteBlogComment','','viewBlog','','deleteBlogComment','Delete Blog Comment','Delete Blog Comment','','','true','','','',''),
 ('editForumPost','','viewForumThread','','editForumPost','Forums - threadTitle - Edit Post','Edit Forum Post','','','true','','viewForum','editForumPostSubmitted',''),
 ('deleteForumPost','','viewForumThread','','deleteForumPost','Forums - threadTitle - DeletePost','Delete Forum Post','','','true','','viewForum','',''),
 ('changeEmail','','','','changeEmail','Change Account Email','Change Account Email','','','','','','',''),
 ('blogHome','','viewBlogHome','','','Blog','Blog','','','','true','','',''),
 ('renameUser','','','','renameUser','Rename User','Rename User','','','','','','renameUserSubmitted','');

CREATE TABLE `forumzDev_permissions` (
  `internalName` text NOT NULL,
  `itemDesc` text NOT NULL,
  `category` text NOT NULL,
  `orderNum` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

insert into `forumzDev_permissions` values('editSiteSettings','Edit Site Settings','Admin','1'),
 ('editMemberRank','Edit Member Rank','Admin','2'),
 ('editRanks','Edit Ranks','Admin','3'),
 ('viewMembersList','View Members List','Admin','6'),
 ('postBlogEntries','Post Blog Entries','Blog','1'),
 ('postBlogComments','Post Blog Comments','Blog','2'),
 ('editBlogEntries','Edit Blog Entries','Blog','3'),
 ('deleteBlogEntries','Delete Blog Entries','Blog','4'),
 ('editBlogComments','Edit Blog Comments','Blog','5'),
 ('deleteBlogComments','Delete Blog Comments','Blog','6'),
 ('viewForum','View Forum','Forums','1'),
 ('createForumThreads','Create Forum Threads','Forums','2'),
 ('createForumPosts','Create Forum Posts','Forums','3'),
 ('editForumPosts','Edit Forum Posts','Forums','4'),
 ('deleteForumPosts','Delete Forum Posts','Forums','5'),
 ('manageForums','Manage Forums','Forums','6'),
 ('useChat','Use Chat','Chat','1'),
 ('flagRenames','Flag Users For Rename','Admin','5'),
 ('banUsers','Ban Users','Admin','4');

CREATE TABLE `forumzDev_ranks` (
  `rankID` int(11) NOT NULL,
  `rankOrder` int(11) NOT NULL,
  `rankName` text NOT NULL,
  `permissions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_ranks` values('0','0','Anonymous','a:15:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:0:\"\";s:15:\"postBlogEntries\";s:0:\"\";s:16:\"postBlogComments\";s:0:\"\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:9:\"viewForum\";s:0:\"\";s:18:\"createForumThreads\";s:0:\"\";s:16:\"createForumPosts\";s:0:\"\";s:14:\"editForumPosts\";s:0:\"\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";s:7:\"useChat\";s:0:\"\";}'),
 ('1','1','Member','a:15:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:0:\"\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:0:\"\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";s:7:\"useChat\";s:0:\"\";}'),
 ('2','3','Admin','a:19:{s:16:\"editSiteSettings\";s:4:\"true\";s:14:\"editMemberRank\";s:4:\"true\";s:9:\"editRanks\";s:4:\"true\";s:8:\"banUsers\";s:4:\"true\";s:11:\"flagRenames\";s:4:\"true\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:4:\"true\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:4:\"true\";s:17:\"deleteBlogEntries\";s:4:\"true\";s:16:\"editBlogComments\";s:4:\"true\";s:18:\"deleteBlogComments\";s:4:\"true\";s:7:\"useChat\";s:4:\"true\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:4:\"true\";s:16:\"deleteForumPosts\";s:4:\"true\";s:12:\"manageForums\";s:4:\"true\";}'),
 ('3','2','Moderator','a:17:{s:16:\"editSiteSettings\";s:0:\"\";s:14:\"editMemberRank\";s:0:\"\";s:9:\"editRanks\";s:0:\"\";s:15:\"viewMembersList\";s:4:\"true\";s:15:\"postBlogEntries\";s:4:\"true\";s:16:\"postBlogComments\";s:4:\"true\";s:15:\"editBlogEntries\";s:0:\"\";s:17:\"deleteBlogEntries\";s:0:\"\";s:16:\"editBlogComments\";s:4:\"true\";s:18:\"deleteBlogComments\";s:0:\"\";s:7:\"useChat\";s:4:\"true\";s:9:\"viewForum\";s:4:\"true\";s:18:\"createForumThreads\";s:4:\"true\";s:16:\"createForumPosts\";s:4:\"true\";s:14:\"editForumPosts\";s:4:\"true\";s:16:\"deleteForumPosts\";s:0:\"\";s:12:\"manageForums\";s:0:\"\";}');

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
  `blogEntriesPerPage` int(11) NOT NULL,
  `facebookLink` text NOT NULL,
  `youtubeLink` text NOT NULL,
  `googleAnalytics` text NOT NULL,
  `metaDesc` text NOT NULL,
  `metaKeywords` text NOT NULL,
  `siteAbout` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_siteSettings` values('1','0-5-5','Forumz','','Dev Version 0.5.5 © 2014 <a href=\"http://www.forumzbb.com/\" target=\"_blank\">ForumzBB</a> - All Rights Reserved','Rudimentary','','','true','','false','4','','','','Forumzbb Development Site.','Forumz, Forumzbb, Development',''),
 ('0','0-5-4','0.5.4','','','','','','','','','0','','','','','',''),
 ('0','0-5-5','0.5.5','','','','','','','','','0','','','','','','');

CREATE TABLE `forumzDev_themes` (
  `themeName` text NOT NULL,
  `themeAddress` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_themes` values('Sky Blue','SkyBlue'),
 ('Rudimentary','Rudimentary');

SET FOREIGN_KEY_CHECKS = 1;
