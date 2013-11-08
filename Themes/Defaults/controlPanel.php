<?php
// Harris Christiansen
// Created 10-19-12

function displayCPNavItem($navItem, $navLink) {
	viewHTML('<a class="controlPanelNavItem" href="'.$navLink.'">'.$navItem.'</a>');
}

function changePasswordForm($siteURL) {
	viewHTML('<form action="'.$siteURL.'controlPanel/changePassword/" method="POST">');
	viewHTML('Current Password: <input type="password" name="oldPass" value=""><br>');
	viewHTML('New Password: <input type="password" name="newPass" value=""><br>');
	viewHTML('Confirm New Password: <input type="password" name="newPassCon" value=""><br>');
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Change Password">');
	viewHTML('</form>');
}

function editProfileForm($currentEmail,$siteURL) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editProfile/" method="POST">');
	viewHTML('Email: <input type="text" name="newEmail" value="'.$currentEmail.'"><br>');
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Change Profile">');
	viewHTML('</form>');
}

function changePreferencesForm($siteURL) {
	viewHTML('Edit Preferences Form');
}

function editSiteSettingsForm($siteURL,$siteName,$siteMotd,$siteSlogan,$siteDisabled,$reqLogin,$numBlogEntriesPerPage) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editSiteSettings/" method="POST">');
	viewHTML('Site Name: <input type="text" name="siteName" value="'.$siteName.'"><br>');
	viewHTML('Site Banner: <input type="text" name="siteMotd" value="'.$siteMotd.'"><br>');
	viewHTML('Site Slogan: <input type="text" name="siteSlogan" value="'.$siteSlogan.'"><br>');
	viewHTML('Site Disabled (Enter Message To Disable): <input type="text" name="siteDisabled" value="'.$siteDisabled.'"><br>');
	viewHTML('Require Login: <input type="checkbox" name="reqLogin" value="true" '.$reqLogin.'><br>');
	viewHTML('<br>');
	viewHTML('Number Blog Entries Per Page: <input type="text" name="numBlogEntriesPerPage" value="'.$numBlogEntriesPerPage.'"><br>');
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Change Site Settings">');
	viewHTML('</form>');
}

function editRanksForm($siteURL,$linkID,$rankName,$settingChecked) {
	viewHTML('<div id="controlPanelNav2">');
	viewHTML('Ranks:<br>');
	displayRankNavItems();
	viewHTML('</div>');
	viewHTML('<div id="controlPanelContent2">');
	
	// If Editing A Specific Rank
	if($linkID!="") {
		viewHTML('<form action="'.$siteURL.'controlPanel/editRanks/'.$linkID.'/" method="POST">');
		viewHTML('Edit Rank:<br>');
	} else {
		viewHTML('<form action="'.$siteURL.'controlPanel/addRank/" method="POST">');
		viewHTML('Add Rank:<br>');
	}
		viewHTML('Rank Name: <input type="text" name="rankName" value="'.$rankName.'"><br>');
		viewHTML('Edit Site Settings: <input type="checkbox" name="editSiteSettings" value="true" '.$settingChecked['editSiteSettings'].'><br>');
		viewHTML('Edit Members Rank: <input type="checkbox" name="editMemberRank" value="true" '.$settingChecked['editMemberRank'].'><br>');
		viewHTML('Edit Ranks: <input type="checkbox" name="editRanks" value="true" '.$settingChecked['editRanks'].'><br>');
		viewHTML('Post Blog Entries: <input type="checkbox" name="postBlogEntries" value="true" '.$settingChecked['postBlogEntries'].'><br>');
		viewHTML('Post Blog Comments: <input type="checkbox" name="postBlogComments" value="true" '.$settingChecked['postBlogComments'].'><br>');
		viewHTML('Edit Blog Entries: <input type="checkbox" name="editBlogEntries" value="true" '.$settingChecked['editBlogEntries'].'><br>');
		viewHTML('Delete Blog Entries: <input type="checkbox" name="deleteBlogEntries" value="true" '.$settingChecked['deleteBlogEntries'].'><br>');
		if($linkID!="") {
			viewHTML('<input type="submit" name="cpFormSubmitted" value="Update Rank">');
		} else {
			viewHTML('<input type="submit" name="cpFormSubmitted" value="Add Rank">');
		}
		viewHTML('</form>');
	
	viewHTML('</div>');
}

function displayRankNavItem($navItem, $navLink, $upArrLink, $dnArrLink) {
	viewHTML('<div class="CPNav2Cont">');
		viewHTML('<a class="controlPanelNav2Item" href="'.$navLink.'">'.$navItem.'</a>');
		viewHTML('<div class="CPNav2Funcs">');
			if($upArrLink!="") {
				viewHTML('<a class="CPNav2Func" href="'.$upArrLink.'">');
					viewHTML('<img src="/Resources/images/upArrowSm.jpg" height="12" width="15">');
				viewHTML('</a>');
			} else {
				viewHTML('<div class="CPNav2Func"></div>');
			}
			if($dnArrLink!="") {
				viewHTML('<a class="CPNav2Func" href="'.$dnArrLink.'">');
					viewHTML('<img src="/Resources/images/dnArrowSm.jpg" height="12" width="15">');
				viewHTML('</a>');
			} else {
				viewHTML('<div class="CPNav2Func"></div>');
			}
		viewHTML('</div>');
	viewHTML('</div>');
}
?>