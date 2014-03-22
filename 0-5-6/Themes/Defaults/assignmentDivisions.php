<?php
// Harris Christiansen
// Created 2014-3-22

// Assignments
function displayAssignmentsHead() {
	viewHTML('<tr class="FullWidthTableHead">');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn1">Assignment</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn2">Created By</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn3">Created</td>');
		viewHTML('<td class="TableHeadColumn forumThreadsColumn4">Priority</td>');
	viewHTML('</tr>');
}
function displayAssignmentsLine($assignLink,$assignName,$createdBy,$createdDate,$priority) {
	viewHTML('<tr class="FullWidthTableRow" onclick="parent.location=\''.$assignLink.'\';">');
		viewHTML('<td class="TableRowColumn forumThreadsColumn1 forumThreadsRow'.$rowID.'">'.$assignName.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn2 forumThreadsRow'.$rowID.'">'.$createdBy.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn3 forumThreadsRow'.$rowID.'">'.$createdDate.'</td>');
		viewHTML('<td class="TableRowColumn forumThreadsColumn4 forumThreadsRow'.$rowID.'">'.$priority.'</td>');
	viewHTML('</tr>');
}

// Assignment
function displayAssignment() {
	
}
?>