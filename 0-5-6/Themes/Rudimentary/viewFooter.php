<?php
// Harris Christiansen
// Created 9-15-12

defaultsInclude('devTools');
defaultsInclude('breadcrumbs');
defaultsInclude('chatSystem');

global $siteSettings;
?>

</div>

<footer>
<div id="grayBar">
	<div class="centerPanel">
	</div>
</div>

<div id="blackBar">
	<? if($siteSettings['youtubeLink']!="") { ?><a href="<? echo $siteSettings['youtubeLink']; ?>" class="noSelect youTubeLink" target="_blank"></a> <? } ?>
	<? if($siteSettings['facebookLink']!="") { ?><a href="<? echo $siteSettings['facebookLink']; ?>" class="noSelect facebookLink" target="_blank"></a> <? } ?>
	<div class="copyright"><? viewHTML(getSiteName()." | ".getSiteSlogan().' | Powered By <a href="http://www.forumzbb.com/" target="_blank">ForumzBB</a>'); ?></div>
</div>
</footer>
</body></html>