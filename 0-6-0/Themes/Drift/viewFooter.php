		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<? if($siteSettings['youtubeLink']!="") { ?><li><a href="<? echo $siteSettings['youtubeLink']; ?>" class="icon fa-youtube" target="_blank"><span class="label">YouTube</span></a></li><? } ?>
					<? if($siteSettings['facebookLink']!="") { ?><li><a href="<? echo $siteSettings['facebookLink']; ?>" class="icon fa-facebook" target="_blank"><span class="label">Facebook</span></a></li><? } ?>
				</ul>
				<ul class="menu">
					<? displayNavBar(); ?>
				</ul>
				<span class="copyright">
					<? viewHTML(getSiteName()." | ".getSiteSlogan().' | Powered By <a href="http://www.forumzbb.com/" target="_blank">ForumzBB</a>'); ?>
				</span>
			</footer>

	</body>
</html>