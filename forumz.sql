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
 ('1','Dr.love','1ff61e91349d3f6623a81ccd3d881fa1','dr.love.rico@gmail.com','0','1','10-22-12','205.124.117.24');

CREATE TABLE `ranks` (
  `rankID` int(11) NOT NULL,
  `rankName` text NOT NULL,
  `editSiteSettings` text NOT NULL,
  `editMemberRank` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `ranks` values('0','Anonymous','false','false'),
 ('1','Member','false','false'),
 ('2','Admin','true','true');

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
  `htmlAllowed` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into `siteSettings` values('1','Forumz','','Dev Version 0.5.1 &copy; 2012 Forumzbb','SkyBlue','','false','false','false','false');

SET FOREIGN_KEY_CHECKS = 1;
