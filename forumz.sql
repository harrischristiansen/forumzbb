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
  `lastLoginIP` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_accounts` values('0','Harris','7af4896825dfc7e94f8a1d6846a5a2d4','cloudy243@me.com','0','2','2013-11-13','67.166.73.129','2013-11-13','67.166.73.129'),
 ('Anonymous','Anonymous','-','Anonymous','-1','0','-','-','-','-'),
 ('1','TestUser','7a95dec218ffaaf8992bb48b4bd94367','testUser@forumzbb.com','0','1','05-12-13','67.161.245.43','5-29-13','67.161.245.43');

CREATE TABLE `forumzDev_bannedClients` (
  `ipAdr` text NOT NULL,
  `actID` text NOT NULL,
  `banInitDay` text NOT NULL,
  `banLength` text NOT NULL,
  `banReason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


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
  `postTIme` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `forumzDev_forumThreads` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
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

insert into `forumzDev_forums` values('0','0','General Forum','For Dev And Testing Of Forumz','0','0','a:4:{s:5:\"title\";s:15:\"The Latest Post\";s:6:\"author\";s:6:\"Harris\";s:4:\"date\";s:7:\"5-29-13\";s:8:\"threadID\";s:1:\"2\";}'),
 ('1','0','General Forum 2','A Second Forum','0','0','a:4:{s:5:\"title\";s:15:\"The Latest Post\";s:6:\"author\";s:6:\"Harris\";s:4:\"date\";s:7:\"5-29-13\";s:8:\"threadID\";s:1:\"2\";}'),
 ('2','1','General Forum 3','A Third Forum','0','0','a:4:{s:5:\"title\";s:15:\"The Latest Post\";s:6:\"author\";s:6:\"Harris\";s:4:\"date\";s:7:\"5-29-13\";s:8:\"threadID\";s:1:\"2\";}');

CREATE TABLE `forumzDev_navBar` (
  `navItemName` text NOT NULL,
  `navItemLink` text NOT NULL,
  `navItemOrder` text NOT NULL,
  `navItemDisplay` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_navBar` values('Home','home','1','loggedOut'),
 ('Members List','membersList','2','loggedOut'),
 ('Login','login','3','loggedOut'),
 ('Register','register','4','loggedOut'),
 ('Home','home','1','loggedIn'),
 ('Forum','forums','2','loggedIn'),
 ('Members List','membersList','3','loggedIn'),
 ('Control Panel','controlPanel','4','loggedIn'),
 ('Logout','logout','5','loggedIn');

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

insert into `forumzDev_pages` values('home','','viewBlogHome','','','Home','','','','','true','','',''),
 ('login','','','','loginUser','Login','Login','','Please Login Above','','','','loginSubmitted',''),
 ('blog','','viewBlog','','checkBlogEntryExists','Blog Entry','Blog Post','','','','true','','',''),
 ('register','','','viewRegistration','registerUser','Register','Register','','','','','','registerSubmitted',''),
 ('logout','','','','logoutUser','Logout','Logout','','','true','','','',''),
 ('membersList','','viewMembersList','','','Members List','Members','','','','true','','',''),
 ('membersList','changeUserRank','viewMembersList','','setUserRank','Members List - Change Member Rank','Set Member Rank','','Action Denied','true','','editMemberRank','newRank',''),
 ('devOutput','','','','writeSessionData','Dev Output','Dev Output','','','','true','','',''),
 ('blog','reply','viewBlog','viewBlog','addBlogComment','Blog Entry - Add Blog Comment','Post Comment','','','','true','postBlogComments','commentSubmitted',''),
 ('controlPanel','','viewControlPanel','','','Control Panel','Control Panel','','','true','','','',''),
 ('controlPanel','changePassword','viewControlPanel','viewControlPanel','updateAccountPassword','Control Panel - Change Password','Control Panel Change Password','','','true','','','cpFormSubmitted',''),
 ('controlPanel','editProfile','viewControlPanel','viewControlPanel','updateAccountProfile','Control Panel - Update Profile','Control Panel Update Profile','','','true','','','cpFormSubmitted',''),
 ('controlPanel','changePreferences','viewControlPanel','viewControlPanel','','Control Panel - Update Preferences','Control Panel Update Preferences','','','true','','','cpFormSubmitted',''),
 ('controlPanel','editSiteSettings','viewControlPanel','viewControlPanel','updateSiteSettings','Control Panel - Update Site Settings','Control Panel Update Site Settings','','','true','','editSiteSettings','cpFormSubmitted',''),
 ('controlPanel','addRank','viewControlPanel','viewControlPanel','addSiteRank','Control Panel - Add Rank','Control Panel Add Rank','','','true','','editRanks','cpFormSubmitted',''),
 ('controlPanel','editRanks','viewControlPanel','viewControlPanel','updateRank','Control Panel - Edit Rank','Control Panel Edit Rank','','','true','','editRanks','cpFormSubmitted',''),
 ('controlPanel','swapRanks','viewControlPanel','viewControlPanel','swapRanks','Control Panel - Edit Rank Order','Control Panel Edit Rank Order','','','true','','editRanks','',''),
 ('composeEntry','','viewBlog','viewBlogCompose','addBlogEntry','Compose Blog Entry','New Entry','','','true','','postBlogEntries','blogComposeSubmitted',''),
 ('editBlog','','viewBlog','viewBlogCompose','editBlogPost','Edit Blog Entry','Edit Blog','','','true','','','blogUpdateSubmitted',''),
 ('deleteBlog','','viewBlogHome','','deleteBlogPost','Delete Blog Entry','Delete Blog','','','true','','','',''),
 ('forums','','viewForumHome','','','Forums Home','Forums Home','','','','true','','',''),
 ('forum','','viewForumThreads','','','Forum Topics - Needs To Dynamically Load Name','Forum Topics - Needs To Dynamically Load Name','','','','true','','',''),
 ('confirmAccount','','','','confirmAccount','Confirm Account','Confirm Account','','','','','','','');

CREATE TABLE `forumzDev_ranks` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_ranks` values('0','0','Anonymous','','','','','','',''),
 ('1','1','Member','','','','','true','',''),
 ('2','3','Admin','true','true','true','true','true','true','true'),
 ('3','2','Writter','','','','true','true','','');

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

insert into `forumzDev_siteSettings` values('1','0-5-4','Forumz','','Dev Version 0.5.4 © 2013 Forumzbb','SkyBlue','','','true','false','false','4');

SET FOREIGN_KEY_CHECKS = 1;
