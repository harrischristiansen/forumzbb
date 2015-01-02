<?php
// Harris Christiansen
// Created 2014-12-31
// Theme: Drift

global $userData, $siteSettings;

themeInclude('siteNotices');
defaultsInclude('navBar');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><? echo getPageTitle(); ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<? displayMetadata(); ?>
		
		<!--- Theme Items --->
		
		<!--[if lte IE 8]><script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/ie/html5shiv.js"></script><![endif]-->
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/jquery.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/jquery.dropotron.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/jquery.scrollgress.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/jquery.scrolly.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/jquery.slidertron.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/skel.min.js"></script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/skel-layers.min.js"></script>
		<script type="text/javascript">var base_url = "<? echo $siteSettings['siteVersionAddress'];?>";</script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/skel.css" />
			<link rel="stylesheet" href="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/style.css" />
			<link rel="stylesheet" href="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/style-xlarge.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Drift/css/ie/v8.css" /><![endif]-->
	
		<!--- ForumzBB Items --->
		
		<!-- Site Scripts -->
		<script>var phpSessionName="<? echo session_name(); ?>";</script>
		<script src="/<? echo $siteSettings['siteVersionAddress'];?>Themes/Defaults/siteScripts.js"></script>
		<!-- bValidator -->
		<link rel="stylesheet" href="/Resources/plugins/bvalidator/validator.css" />
		<script src="/Resources/plugins/bvalidator/jquery.bvalidator.js"></script>
		<!-- SCEditor -->
		<link rel="stylesheet" href="/Resources/plugins/sceditor/minified/themes/monocons.min.css" type="text/css" media="all" />
		<script type="text/javascript" src="/Resources/plugins/sceditor/minified/jquery.sceditor.bbcode.min.js"></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="/"><? echo getSiteName(); ?></a></h1>
				<nav id="nav"><ul>
					<? displayNavBar(); ?>
				</ul></nav>
			</header>
		
		<? global $displayNotices; if ($displayNotices != "no") { ?>
		<section id="notices" class="wrapper style1">
			<? displayAllNotices(); ?>
		</section>
		<? } ?>