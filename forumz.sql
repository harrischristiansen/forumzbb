SET NAMES latin1;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `accounts` (
  `actID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `actStatus` int(11) NOT NULL COMMENT '0=active, 1=waitingEmailVerification, 2=waitingAdminVerification, 3=banned',
  `rankID` int(11) NOT NULL,
  `joinDate` text NOT NULL,
  `ipAddress` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `accounts` values('0','Harris','7af4896825dfc7e94f8a1d6846a5a2d4','cloudy243@me.com','0','2','10-03-12','205.124.117.24'),
 ('1','TestUser','7a95dec218ffaaf8992bb48b4bd94367','testUser@forumzbb.com','0','1','05-12-13','67.161.245.43');

CREATE TABLE `blogComments` (
  `idNum` int(11) NOT NULL,
  `blogID` int(11) NOT NULL,
  `posterID` int(11) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `blogComments` values('0','11','0','05-12-13','19:35','Test of Comment System');

CREATE TABLE `blogs` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Author` text NOT NULL,
  `AuthorDate` text NOT NULL,
  `AuthorTime` text NOT NULL,
  `Post` text NOT NULL,
  `numComments` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `blogs` values('1','Entry 2','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('2','Entry 3','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('3','Entry 4','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('4','Entry 5','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('5','Entry 6','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('6','Entry 7','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('7','Entry 8','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('8','Entry 9','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('9','Entry 10','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('10','Entry 11','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('11','Entry 12','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2'),
 ('0','Entry 1','0','11-03-12','13:19:50','Test Of Blog System<br>\nBlah Blah Blah<br>\nHum Hum Hum','2');

CREATE TABLE `ranks` (
  `rankID` int(11) NOT NULL,
  `rankOrder` int(11) NOT NULL,
  `rankName` text NOT NULL,
  `editSiteSettings` text NOT NULL,
  `editMemberRank` text NOT NULL,
  `postBlogEntries` text NOT NULL,
  `postBlogComments` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `ranks` values('0','0','Anonymous','false','false','false','false'),
 ('1','1','Member','false','false','false','true'),
 ('2','3','Admin','true','true','true','true'),
 ('3','2','Level 2 Member','false','false','false','true');

CREATE TABLE `siteSettings` (
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

insert into `siteSettings` values('1','Forumz','','Dev Version 0.5.2 © 2012 Forumzbb','SkyBlue','','','false','false','false','4');

SET FOREIGN_KEY_CHECKS = 1;
