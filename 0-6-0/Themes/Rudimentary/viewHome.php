<?php
// Harris Christiansen
// Created 2012-09-15
// Theme: Rudimentary

themeInclude('blogDivisions');
defaultsInclude('registerLoginFields');
global $siteSettings;

display('viewHeader');

viewHTML('<div id="leftSite"><div class="panelHead">Recent Posts</div>');
viewBlogEntries();
if(userCan('postBlogEntries')) {
	viewHTML('<a class="newItemBtn" href="'.$siteSettings['siteURLShort'].'composeEntry/">Add Entry</a>');
}
viewHTML('</div>');

viewHTML('<div id="rightSite">');
	if(!isLoggedIn()) {
		viewHTML('<div class="panelHead">Log In</div>');
		viewHTML('<div class="siteContPanel whitePanel">');
			viewMultiLineLoginField();
		viewHTML('</div><br>');
	}
	if($siteSettings['siteAbout']!="") {
		viewHTML('<div class="panelHead">About</div>');
		viewHTML('<div class="siteContPanel whitePanel">');
			viewHTML($siteSettings['siteAbout']);
		viewHTML('</div>');
	}
viewHTML('</div>');

viewHTML('<div class="clearBoth"></div>');

display('viewFooter');
?>