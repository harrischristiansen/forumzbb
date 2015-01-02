<?php
// Harris Christiansen
// Created 10-3-12

function displayMembersListHead() {
	viewHTML('<thead><tr class="FullWidthTableHead">');
		viewHTML('<th class="TableHeadColumn membersListColumn1">Username</th>');
		viewHTML('<th class="TableHeadColumn membersListColumn2">Rank</th>');
		viewHTML('<th class="TableHeadColumn membersListColumn3">Join Date</th>');
		viewHTML('<th class="TableHeadColumn membersListColumn4">Last Login</th>');
	viewHTML('</tr></thead>');
}
function displayMembersListRow($userName, $userRank, $dateJoined, $lastLogin, $actID, $rowID, $cngRankFormDisplay) {
	viewHTML('<tr class="FullWidthTableRow">');
		viewHTML('<td class="TableRowColumn membersListColumn1 membersListRow'.$rowID.'">'.$userName.'</td>');
		viewHTML('<td class="TableRowColumn membersListColumn2 membersListRow'.$rowID.'">');
			if($cngRankFormDisplay) {
				getChangeRankList($actID);
			} else {
				viewHTML($userRank);
			}
		viewHTML('</td>');
		viewHTML('<td class="TableRowColumn membersListColumn3 membersListRow'.$rowID.'">'.$dateJoined.'</td>');
		viewHTML('<td class="TableRowColumn membersListColumn4 membersListRow'.$rowID.'">'.$lastLogin.'</td>');
	viewHTML('</tr>');
}
?>