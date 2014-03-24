<?php
// Harris Christiansen
// Created 2014-3-22

// Assignments
function displayAssignmentsHead() {
	viewHTML('<table class="FullWidthTable">');
	viewHTML('<tr class="FullWidthTableHead">');
		viewHTML('<td class="TableHeadColumn assignmentsColumn1">Assignment</td>');
		viewHTML('<td class="TableHeadColumn assignmentsColumn2">Status</td>');
		viewHTML('<td class="TableHeadColumn assignmentsColumn3">Created</td>');
		viewHTML('<td class="TableHeadColumn assignmentsColumn4">Priority</td>');
	viewHTML('</tr>');
}
function displayAssignmentsLine($assignLink,$assignName,$assignStatus,$createdDate,$priority) {
	viewHTML('<tr class="FullWidthTableRow" onclick="parent.location=\''.$assignLink.'\';">');
		viewHTML('<td class="TableRowColumn assignmentsColumn1 assignmentsRow'.$rowID.'">'.$assignName.'</td>');
		viewHTML('<td class="TableRowColumn assignmentsColumn2 assignmentsRow'.$rowID.'">'.$assignStatus.'</td>');
		viewHTML('<td class="TableRowColumn assignmentsColumn3 assignmentsRow'.$rowID.'">'.$createdDate.'</td>');
		viewHTML('<td class="TableRowColumn assignmentsColumn4 assignmentsRow'.$rowID.'">'.$priority.'</td>');
	viewHTML('</tr>');
}

// Assignment
function displayAssignment($assignName, $assignInfo) {
	viewHTML('<div class="fullSite">');
		viewHTML('<div class="panelHead">Assignment - '.$assignName.'</div>');
		viewHTML('<div class="siteContPanel whitePanel">');
			viewHTML('<b>Description:</b> '.$assignInfo['taskDesc'].'<br><br>');
			viewHTML('<b>Status:</b> '.$assignInfo['taskStatus'].'<br>');
			viewHTML('<b>Priority:</b> '.$assignInfo['taskPriority'].'<br><br>');
			viewHTML('<b>Created:</b> '.$assignInfo['createDate'].'<br>');
			if($assignInfo['claimDate']!="") {
				viewHTML('<b>Claimed:</b> '.$assignInfo['claimDate'].' by '.$assignInfo['claimUser'].'<br>');
				if($assignInfo['closeDate']!="") {
					viewHTML('<b>Closed:</b> '.$assignInfo['closeDate'].' by '.$assignInfo['closeUser'].'<br>');
				} else {
					viewHTML('<br><b>Complete Assignment:</b><br>');
					viewHTML('<b>Notes:</b><br>');
					viewHTML('<form action="'.$assignInfo['closeLink'].'" method="POST" enctype="multipart/form-data" class="validateForm">');
						viewHTML('<textarea name="taskNotes" class="newBlogEntryTextArea sceditor"');
						if($assignInfo['taskRequirement']=="Text") { viewHTML(' data-bvalidator="required"'); } // Does not make required because of sceditor
						viewHTML('></textarea><br>');
						if($assignInfo['taskRequirement']=="File") { viewHTML('<b>File:</b> <input type="file" name="file" data-bvalidator="required"><br>'); }
						viewHTML('<input type="submit" name="closeAssignmentSubmitted" value="Complete">');
					viewHTML('</form>');
				}
			} else {
				viewHTML('<b>Claim:</b> <a href="'.$assignInfo['claimLink'].'"><button type="button">Claim</button></a><br>');
			}
			viewHTML('<br>');
			if($assignInfo['cancelLink']!="") {
				viewHTML('<b>Cancel:</b> <a href="'.$assignInfo['cancelLink'].'"><button type="button">Cancel</button></a><br><br>');
			}
			if($assignInfo['taskRequirement']!="None") {
				viewHTML('<b>Requirements:</b> '.$assignInfo['taskRequirement'].'<br><br>');
			}
			if($assignInfo['taskNotes']!="") {
				viewHTML('<b>Notes:</b> '.$assignInfo['taskNotes'].'<br><br>');
			}
			if($assignInfo['taskFile']!="") {
				viewHTML('<b>File:</b> '.$assignInfo['taskFile'].'<br><br>');
			}
		viewHTML('</div><br>');
		if($assignInfo['reopenAssign']=="yes") {
			viewHTML('<div class="panelHead">Reopen Assignment</div>');
		viewHTML('<div class="siteContPanel whitePanel">');
			viewHTML('<form action="'.$assignInfo['reopenLink'].'" method="POST" class="validateForm">');
				viewHTML('<table class="centerTable">');
					viewHTML('<tr><td>Assignment Comment:</td> <td><textarea name="taskDesc" data-bvalidator="required" class="newBlogEntryTextArea sceditor"></textarea></td></tr>');
					
					viewHTML('<tr><td>Assignment Priority:</td> <td><select name="taskPriority" data-bvalidator="required">');
						viewHTML('<option value="0" selected>Low</option>');
						viewHTML('<option value="1">Medium</option>');
						viewHTML('<option value="2">High</option>');
					viewHTML('</select></td></tr>');
					
					viewHTML('<tr><td>Assignment Requirement:</td> <td><select name="taskRequirement" data-bvalidator="required">');
						viewHTML('<option value="None" selected>None</option>');
						viewHTML('<option value="File">File Upload</option>');
						viewHTML('<option value="Text">Text Input</option>');
					viewHTML('</select></td></tr>');
					
					viewHTML('<tr><td colspan="2"><input type="submit" name="openAssignmentSubmitted" value="Open"></td></tr>');
				viewHTML('</table>');
			viewHtml('</form><br><br>');

			// File Uploader
			viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
				viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
			viewHTML('</form>');
			viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
		viewHTML('</div>');
		}
	viewHTML('</div>');
}

// Create Assignment
function displayCreateAssignmentForm() {
	global $siteSettings;
	viewHTML('<div class="fullSite">');
		viewHTML('<div class="panelHead">Create Assignment</div>');
		viewHTML('<div class="siteContPanel whitePanel">');
			viewHTML('<form action="'.$siteSettings['siteURLShort'].'createAssignment" method="POST" class="validateForm">');
				viewHTML('<table class="centerTable">');
					viewHTML('<tr><td>Assignment Name:</td> <td><input type="text" name="taskName" value="" data-bvalidator="required"></td></tr>');
					
					viewHTML('<tr><td>Assignment Description:</td> <td><textarea name="taskDesc" data-bvalidator="required" class="newBlogEntryTextArea sceditor"></textarea></td></tr>');
					
					viewHTML('<tr><td>Assignment Priority:</td> <td><select name="taskPriority" data-bvalidator="required">');
						viewHTML('<option value="0" selected>Low</option>');
						viewHTML('<option value="1">Medium</option>');
						viewHTML('<option value="2">High</option>');
					viewHTML('</select></td></tr>');
					
					viewHTML('<tr><td>Assignment Requirement:</td> <td><select name="taskRequirement" data-bvalidator="required">');
						viewHTML('<option value="None" selected>None</option>');
						viewHTML('<option value="File">File Upload</option>');
						viewHTML('<option value="Text">Text Input</option>');
					viewHTML('</select></td></tr>');
					
					viewHTML('<tr><td colspan="2"><input type="submit" name="createAssignmentSubmitted" value="Create"></td></tr>');
				viewHTML('</table>');
			viewHtml('</form><br><br>');

			// File Uploader
			viewHTML('<form action="/Resources/uploads/fileUpload.php" method="POST" enctype="multipart/form-data" target="upload">');
				viewHTML('File Upload: <input type="file" name="file"><input type="submit" value="Upload">');
			viewHTML('</form>');
			viewHTML('<iframe style="display: none; visibility: hidden; height: 0; width: 0;" id="upload" name="upload"></iframe>');
		viewHTML('</div>');
	viewHTML('</div>');
}
?>