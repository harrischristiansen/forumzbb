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

insert into `forumzDev_accounts` values('0','Harris','7af4896825dfc7e94f8a1d6846a5a2d4','cloudy243@me.com','0','2','10-03-12','205.124.117.24','5-28-13','67.161.245.43'),
 ('Anonymous','Anonymous','-','Anonymous','0','0','-','-','-','-'),
 ('1','TestUser','7a95dec218ffaaf8992bb48b4bd94367','testUser@forumzbb.com','0','1','05-12-13','67.161.245.43','5-27-13','67.161.245.43');

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
  `Post` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_blogs` values('1','Forumz 0.5.3 Dev','0','5-17-13','23:03','Development Site For ForumzBB - Version 0.5.3');

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
  `requireFormSubmitted` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `forumzDev_pages` values('home','','viewHome','','','Home','','','','','true','',''),
 ('login','','viewHome','','loginUser','Login','Login','','Please Login Above','','','','loginSubmitted'),
 ('blog','','viewBlog','','checkBlogEntryExists','Blog Post','Blog Post','','','','true','',''),
 ('register','','','viewRegistration','registerUser','Register','Register','','','','','','registerSubmitted'),
 ('logout','','viewHome','','logoutUser','Logout','Logout','','','','','',''),
 ('membersList','','viewMembersList','','','Members List','Members','','','','','',''),
 ('membersList','changeUserRank','viewMembersList','','setUserRank','','Set Member Rank','','Action Denied','true','','editMemberRank','newRank'),
 ('devOutput','','','','writeSessionData','Dev Output','Dev Output','','','','','',''),
 ('blog','reply','viewBlog','viewBlog','addBlogComment','','Post Comment','','','','true','postBlogComments','commentSubmitted'),
 ('controlPanel','','viewControlPanel','','','Control Panel','Control Panel','','','true','','',''),
 ('controlPanel','changePassword','viewControlPanel','viewControlPanel','updateAccountPassword','Control Panel Change Password','Control Panel Change Password','','','true','','','cpFormSubmitted'),
 ('controlPanel','editProfile','viewControlPanel','viewControlPanel','updateAccountProfile','Control Panel Update Profile','Control Panel Update Profile','','','true','','','cpFormSubmitted'),
 ('controlPanel','changePreferences','viewControlPanel','viewControlPanel','','Control Panel Update Preferences','Control Panel Update Preferences','','','true','','','cpFormSubmitted'),
 ('controlPanel','editSiteSettings','viewControlPanel','viewControlPanel','updateSiteSettings','Control Panel Update Site Settings','Control Panel Update Site Settings','','','true','','editSiteSettings','cpFormSubmitted'),
 ('controlPanel','addRank','viewControlPanel','viewControlPanel','addSiteRank','Control Panel Add Rank','Control Panel Add Rank','','','true','','editRanks','cpFormSubmitted'),
 ('controlPanel','editRanks','viewControlPanel','viewControlPanel','updateRank','Control Panel Edit Rank','Control Panel Edit Rank','','','true','','editRanks','cpFormSubmitted'),
 ('controlPanel','swapRanks','viewControlPanel','viewControlPanel','swapRanks','Control Panel Edit Rank Order','Control Panel Edit Rank Order','','','true','','editRanks',''),
 ('composeEntry','','viewBlog','viewBlogCompose','addBlogEntry','Compose Blog Entry','New Entry','','','true','','postBlogEntries','blogComposeSubmitted'),
 ('editBlog','','','','','Edit Blog Entry','Edit Blog','','','true','','editBlogEntries',''),
 ('deleteBlog','','viewHome','','deleteBlogPost','Delete Blog Entry','Delete Blog','','','true','','deleteBlogEntries','');

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

insert into `forumzDev_ranks` values('0','0','Anonymous','false','false','false','false','false','',''),
 ('1','1','Member','','','','','true','',''),
 ('2','3','Admin','true','true','true','true','true','true','true'),
 ('3','2','Writter','','','','true','true','','');

CREATE TABLE `forumzDev_siteSettings` (
  `settingsProfile` text NOT NULL,
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

insert into `forumzDev_siteSettings` values('1','Forumz','','Dev Version 0.5.3 © 2013 Forumzbb','SkyBlue','','','false','false','false','4');

SET FOREIGN_KEY_CHECKS = 1;
