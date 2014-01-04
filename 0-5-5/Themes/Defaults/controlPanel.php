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

function editProfileForm($siteURL,$currentEmail) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editProfile/" method="POST">');
	viewHTML('Email: <input type="text" name="newEmail" value="'.$currentEmail.'"><br>');
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Change Profile">');
	viewHTML('</form>');
}

function changePreferencesForm($siteURL) {
	viewHTML('<form action="'.$siteURL.'controlPanel/changePreferences/" method="POST">');
	viewHTML('Site Theme: <select name="siteTheme">'.getUserThemeOptions().'</select><br>');
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Update Preferences">');
	viewHTML('</form>');
}

function editSiteSettingsForm($siteURL,$siteName,$siteMotd,$siteSlogan,$siteDisabled,$reqLogin,$numBlogEntriesPerPage) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editSiteSettings/" method="POST">');
	viewHTML('Site Name: <input type="text" name="siteName" value="'.$siteName.'"><br>');
	viewHTML('Site Version: <select name="siteVersion">'.getSiteVersionOptions().'</select><br>');
	viewHTML('Default Theme: <select name="siteTheme">'.getSiteThemeOptions().'</select><br>');
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
		
		
	$permissionsTable = getPermissionsTable();
	$currentCat = "";
	while($permission = mysqli_fetch_array($permissionsTable)) {
		if($currentCat!=$permission['category']) {
			viewHTML('<br><u>'.$permission['category'].'</u><br>');
			$currentCat=$permission['category'];
		}
		viewHTML($permission['itemDesc'].': <input type="checkbox" name="'.$permission['internalName'].'" value="true" '.$settingChecked[$permission['internalName']].'><br>');
	}
	viewHTML('<br>');
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