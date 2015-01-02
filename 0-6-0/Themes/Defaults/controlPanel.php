<?php
// Harris Christiansen
// Created 2012-10-19

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
	global $siteSettings;
	viewHTML('<form action="'.$siteURL.'controlPanel/changePreferences/" method="POST">');
	if($siteSettings['userTheme']) { viewHTML('Site Theme: <select name="siteTheme">'.getUserThemeOptions().'</select><br>'); }
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Update Preferences">');
	viewHTML('</form>');
}

function editSiteSettingsForm($siteURL,$siteName,$userTheme,$siteMotd,$siteSlogan,$siteDisabled,$reqLogin,$verifyRegisterEmail,$verifyRegisterAdmin,$numBlogEntriesPerPage,$htmlAllowed,$facebookLink,$youtubeLink,$googleAnalytics,$metaDesc,$metaKeywords,$siteAbout) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editSiteSettings/" method="POST">');
	viewHTML('Site Name: <input type="text" name="siteName" value="'.$siteName.'"><br>');
	viewHTML('Default Theme: <select name="siteTheme">'.getSiteThemeOptions().'</select><br>');
	viewHTML('<input type="checkbox" name="userTheme" id="userTheme" value="true" '.$userTheme.'><label for="userTheme">User Can Change Personal Theme</label><br>');
	viewHTML('Site Banner: <input type="text" name="siteMotd" value="'.$siteMotd.'"><br>');
	viewHTML('Site Slogan: <input type="text" name="siteSlogan" value="'.$siteSlogan.'"><br>');
	viewHTML('Site Disabled (Enter Message To Disable): <input type="text" name="siteDisabled" value="'.$siteDisabled.'"><br>');
	viewHTML('<input type="checkbox" name="reqLogin" id="reqLogin" value="true" '.$reqLogin.'><label for="reqLogin">Require Login</label><br>');
	viewHTML('<input type="checkbox" name="verifyRegisterEmail" id="verifyRegisterEmail" value="true" '.$verifyRegisterEmail.'><label for="verifyRegisterEmail">Require Email Verification of New Accounts</label><br>');
	viewHTML('<input type="checkbox" name="verifyRegisterAdmin" id="verifyRegisterAdmin" value="true" '.$verifyRegisterAdmin.'><label for="verifyRegisterAdmin">Require Admin Verification of New Accounts</label><br>');
	viewHTML('<br>');
	viewHTML('Number Blog Entries Per Page: <input type="text" name="numBlogEntriesPerPage" value="'.$numBlogEntriesPerPage.'"><br>');
	viewHTML('<br>');
	viewHTML('<input type="checkbox" name="htmlAllowed" id="htmlAllowed" value="true" '.$htmlAllowed.'><label for="htmlAllowed">HTML Allowed in Posts</label><br>');
	viewHTML('<br>');
	viewHTML('Facebook Link: <input type="text" name="facebookLink" value="'.$facebookLink.'"><br>');
	viewHTML('Youtube Link: <input type="text" name="youtubeLink" value="'.$youtubeLink.'"><br>');
	viewHTML('Google Analytics: <input type="text" name="googleAnalytics" value="'.$googleAnalytics.'"><br>');
	viewHTML('Meta Desc: <input type="text" name="metaDesc" value="'.$metaDesc.'"><br>');
	viewHTML('Meta Keywords: <input type="text" name="metaKeywords" value="'.$metaKeywords.'"><br>');
	viewHTML('Site About: <input type="text" name="siteAbout" value="'.$siteAbout.'"><br>');
	
	viewHTML('<input type="submit" name="cpFormSubmitted" value="Change Site Settings">');
	viewHTML('</form>');
}

function editBBCodeForm() {
	viewHTML('<table class="FullWidthTable"><tr class="FullWidthTableHead"><td class="TableHeadColumn" style="width: 20%;">BB Code Tag</td><td class="TableHeadColumn" style="width: 60%;">Replacement HTML</td><td class="TableHeadColumn" style="width: 18%;">Action</td></tr>');
	getEditBBCodeTable();
	viewHTML('</table>');
}

function viewEditBBCodeTableRow($siteURL,$idNum,$bbCode,$replacement) {
	viewHTML('<form action="'.$siteURL.'controlPanel/editBBCode/" method="POST"><tr class="FullWidthTableRow">');
	viewHTML('<td class="TableRowColumn"><input type="hidden" name="bbCodeId" value="'.$idNum.'"><input type="text" name="bbCode" value="'.$bbCode.'" style="width: 90%;"></td>');
	viewHTML('<td class="TableRowColumn"><input type="text" name="replacement" value="'.$replacement.'"style="width: 90%;"></td>');
	viewHTML('<td class="TableRowColumn"><input type="checkbox" name="deleteBBCode" id="deleteBBCode" value="delete"><label for="deleteBBCode">Delete</label><input type="submit" name="cpFormSubmitted" value="Update BBCode"></td>');
	viewHTML('</tr></form>');
	
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
		viewHTML('<input type="checkbox" name="'.$permission['internalName'].'" id="'.$permission['internalName'].'" value="true" '.$settingChecked[$permission['internalName']].'><label for="'.$permission['internalName'].'">'.$permission['itemDesc'].'</label><br>');
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