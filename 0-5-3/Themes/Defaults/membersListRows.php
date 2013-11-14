<?php
// Harris Christiansen
// Created 10-3-12
// Updated 10-29-12

function displayMembersListHead() {
	viewHTML('<div class="FullWidthTableHead">');
	viewHTML('<div class="TableHeadColumn membersListColumn1">Username</div>');
	viewHTML('<div class="TableHeadColumn membersListColumn2">Rank</div>');
	viewHTML('<div class="TableHeadColumn membersListColumn3">Join Date</div>');
	viewHTML('</div>');
}
function displayMembersListRow($userName, $userRank, $dateJoined, $actID, $rowID, $cngRankFormDisplay) {
	viewHTML('<div class="FullWidthTableRow">');
	viewHTML('<div class="TableRowColumn membersListColumn1 membersListRow'.$rowID.'">'.$userName.'</div>');
	viewHTML('<div class="TableRowColumn membersListColumn2 membersListRow'.$rowID.'">');
	if($cngRankFormDisplay) {
		getChangeRankList($actID);
	} else {
		viewHTML($userRank);
	}
	viewHTML('</div>');
	viewHTML('<div class="TableRowColumn membersListColumn3 membersListRow'.$rowID.'">'.$dateJoined.'</div>');
	viewHTML('</div>');
}
?>