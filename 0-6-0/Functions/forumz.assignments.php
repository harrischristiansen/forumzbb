<?
// Harris Christiansen
// Created 2014-3-22

////////// View Assignments //////////

function viewAssignmentsHome() {
	global $siteSettings, $pageID;
	if($pageID=="closed") {
		$assignments=getAssignmentsClosed();
	} else {
		$assignments=getAssignmentsOpen();
	}
	$rowID=0;
	displayAssignmentsHead();
	if(userCan('addAssignments')&&$pageID!="closed") {
		$closedLink = $siteSettings['siteURLShort'].'assignments/closed';
		displayAssignmentsLine($closedLink,'View Closed Assignments','','','');
	}elseif(userCan('addAssignments')&&$pageID=="closed") {
		$closedLink = $siteSettings['siteURLShort'].'assignments';
		displayAssignmentsLine($closedLink,'View Open Assignments','','','');
	}
	while($assignment = mysqli_fetch_array($assignments)) {
		$assignLink = $siteSettings['siteURLShort'].'assignment/'.$assignment['taskID'];
		// Get Task Status
		if($assignment['taskStatus']==0) {
			$taskStatus="Open";
		}elseif($assignment['taskStatus']==1) {
			$taskStatus="Closed";
		}
		if($assignment['closeUser']!="") {
			$taskStatus = $taskStatus." - Complete";
		}elseif($assignment['claimUser']!="") {
			$taskStatus = $taskStatus." - Claimed";
		}
		// Get Task Priority
		if($assignment['taskPriority']==0) {
			$taskPriority="Low";
		}elseif($assignment['taskPriority']==1) {
			$taskPriority='<span style="color: orange;">Medium</span>';
		}elseif($assignment['taskPriority']==2) {
			$taskPriority='<span style="color: red;">High</span>';
		}
		displayAssignmentsLine($assignLink,$assignment['taskName'],$taskStatus,$assignment['createDate'],$taskPriority);
		$rowID++;
	}
	if($rowID==0) {
		displayAssignmentsLine('#',"No Assignments Found",'','','');
	}
	viewHTML('</table>');
	
	if(userCan('addAssignments')) {
		displayCreateAssignmentForm();
	}
	displayCreateDevAssignmentForm();
}

function getAssignmentsOpen() {
	$sql = "SELECT * FROM assignments WHERE taskStatus='0' ORDER BY createDate DESC";
	$result = dbQuery($sql) or die ("Query failed: getAssignmentsOpen");
	return $result;
}

function getAssignmentsClosed() {
	$sql = "SELECT * FROM assignments WHERE taskStatus='1' ORDER BY createDate DESC";
	$result = dbQuery($sql) or die ("Query failed: getAssignmentsClosed");
	return $result;
}

function getNumAssignments() {
	$sql = "SELECT * FROM assignments";
	$result = dbQuery($sql) or die ("Query failed: getNumAssignments");
	return mysqli_num_rows($result);
}

////////// View Assignment //////////

function viewAssignment() {
	global $pageID, $siteSettings;
	$assignment = getAssignmentByID($pageID);
	$assignName = $assignment['taskName'];
	$assignInfo['taskDesc'] = $assignment['taskDesc'];
	// Get Task Status
	if($assignment['taskStatus']==0) {
		$assignInfo['taskStatus']="Open";
	}elseif($assignment['taskStatus']==1) {
		$assignInfo['taskStatus']="Closed";
	}
	if($assignment['closeUser']!="") {
		$assignInfo['taskStatus'] = $assignInfo['taskStatus']." - Complete";
	}elseif($assignment['claimUser']!="") {
		$assignInfo['taskStatus'] = $assignInfo['taskStatus']." - Claimed";
	}
	// Get Task Priority
	if($assignment['taskPriority']==0) {
		$assignInfo['taskPriority']="Low";
	}elseif($assignment['taskPriority']==1) {
		$assignInfo['taskPriority']="Medium";
	}elseif($assignment['taskPriority']==2) {
		$assignInfo['taskPriority']="High";
	}
	$assignInfo['createDate'] = $assignment['createDate'];
	$assignInfo['claimUser'] = getUsername($assignment['claimUser']);
	$assignInfo['claimDate'] = $assignment['claimDate'];
	$assignInfo['closeUser'] = getUsername($assignment['closeUser']);
	$assignInfo['closeDate'] = $assignment['closeDate'];
	$taskOptions = unserialize($assignment['taskOptions']);
	$assignInfo['taskRequirement'] = $taskOptions['taskRequirement'];
	$assignInfo['taskNotes'] = $taskOptions['taskNotes'];
	$assignInfo['taskFile'] = $taskOptions['taskFile'];
	$assignInfo['claimLink'] = $siteSettings['siteURLShort'].'assignment/'.$pageID.'/claim';
	$assignInfo['closeLink'] = $siteSettings['siteURLShort'].'assignment/'.$pageID.'/close';
	if(userCan("addAssignments")&&$assignment['taskStatus']!="1") {
		$assignInfo['cancelLink'] = $siteSettings['siteURLShort'].'assignment/'.$pageID.'/cancel';
	}
	if(userCan("addAssignments")&&$assignment['taskStatus']=="1") {
		$assignInfo['reopenAssign'] = "yes";
		$assignInfo['reopenLink'] = $siteSettings['siteURLShort'].'assignment/'.$pageID.'/reopen';
	}
	
	displayAssignment($assignName, $assignInfo);
}

function getAssignmentByID($taskID) {
	$sql = "SELECT * FROM assignments WHERE taskID='$taskID'";
	$result = dbQuery($sql) or die ("Query failed: getAssignmentByID");
	return mysqli_fetch_array($result);
}

function claimAssignment() {
	global $pageID;
	$claimUser = returnUserID();
	$claimDate = returnDateOfficial();
	$sql = "UPDATE assignments SET claimUser='$claimUser',claimDate='$claimDate' WHERE taskID='$pageID'";
	$result = dbQuery($sql) or die ("Query failed: claimAssignment");
	addSuccessNotice('Assignment Claimed');
}

function closeAssignment() {
	global $pageID, $pagePost;
	$closeUser = returnUserID();
	$closeDate = returnDateOfficial();
	$closeTime = returnTime();
	$assignment = getAssignmentByID($pageID);
	$taskOptions = unserialize($assignment['taskOptions']);
	$taskOptions['taskNotes'] = $taskOptions['taskNotes'].'<br><b>'.$closeDate.':</b> '.formatPost($pagePost['taskNotes']);
	if(!(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))) {
		$fileName = returnUsername().'.'.$closeDate.'.'.$closeTime.'.'.$_FILES["file"]["name"];
    	move_uploaded_file($_FILES["file"]["tmp_name"],"Resources/uploads/".$fileName);
		$taskOptions['taskFile'] = $taskOptions['taskFile'].$closeDate.': <a href="/Resources/uploads/'.cleanInput($fileName).'" target="_blank">'.cleanInput($fileName).'</a><br>';
	}
	$taskOptionsSerialized = serialize($taskOptions);
	$sql = "UPDATE assignments SET closeUser='$closeUser',closeDate='$closeDate',taskStatus='1',taskOptions='$taskOptionsSerialized' WHERE taskID='$pageID'";
	$result = dbQuery($sql) or die ("Query failed: closeAssignment");
	addSuccessNotice('Assignment Complete');
}

function cancelAssignment() {
	global $pageID;
	$sql = "UPDATE assignments SET taskStatus='1' WHERE taskID='$pageID'";
	$result = dbQuery($sql) or die ("Query failed: cancelAssignment");
	addSuccessNotice('Assignment Canceled');
}

////////// Create Assignments //////////

function createDevAssignment() {
	global $pagePost, $pageID;
	$taskID=getNumAssignments();
	$taskName=cleanInput($pagePost['taskName']);
	$createDate=returnDateOfficial();
	$createTime=returnDateOfficial();
	$createUser = returnUserID();
	$taskDesc='<br><b>'.$createDate.':</b> '.formatPost($pagePost['taskDesc']);
	$taskPriority="0";
	$taskOptions['taskNotes']=$taskDesc;
	$taskOptions['taskRequirement']="File";
	if(!(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))) {
		$fileName = returnUsername().'.'.$createDate.'.'.$createTime.'.'.$_FILES["file"]["name"];
    	move_uploaded_file($_FILES["file"]["tmp_name"],"Resources/uploads/".$fileName);
		$taskOptions['taskFile'] = $taskOptions['taskFile'].$closeDate.': <a href="/Resources/uploads/'.cleanInput($fileName).'" target="_blank">'.cleanInput($fileName).'</a><br>';
	}
	$taskOptionsSerialized = serialize($taskOptions);
	
	$sql = "INSERT INTO assignments (taskID, taskStatus, taskPriority, taskName, taskDesc, taskOptions, createDate, claimUser, claimDate, closeUser, closeDate) VALUES ('$taskID', '1', '$taskPriority', '$taskName', '$taskDesc', '$taskOptionsSerialized', '$createDate', '$createUser', '$createDate', '$createUser', '$createDate')";
	$result = dbQuery($sql) or die ("Query failed: createDevAssignment");
	
	$pageID=$taskID; // For Viewing Assignment After
	
	addSuccessNotice("Success");
}

function createAssignment() {
	global $pagePost, $pageID;
	$taskID=getNumAssignments();
	$taskName=cleanInput($pagePost['taskName']);
	$createDate=returnDateOfficial();
	$taskDesc='<br><b>'.$createDate.':</b> '.formatPost($pagePost['taskDesc']);
	$taskPriority=cleanInput($pagePost['taskPriority']);
	$taskOptions['taskRequirement']=cleanInput($pagePost['taskRequirement']);
	$taskOptionsSerialized = serialize($taskOptions);
	
	$sql = "INSERT INTO assignments (taskID, taskStatus, taskPriority, taskName, taskDesc, taskOptions, createDate) VALUES ('$taskID', '0', '$taskPriority', '$taskName', '$taskDesc', '$taskOptionsSerialized', '$createDate')";
	$result = dbQuery($sql) or die ("Query failed: createAssignment");
	
	$pageID=$taskID; // For Viewing Assignment After
	
	addSuccessNotice("Assignment Created");
}

function reopenAssignment() {
	global $pagePost, $pageID;
	
	$assignment = getAssignmentByID($pageID);
	
	$createDate=returnDateOfficial();
	$taskDesc=$assignment['taskDesc'].'<br><b>'.$createDate.':</b> '.formatPost($pagePost['taskDesc']);
	$taskPriority=cleanInput($pagePost['taskPriority']);
	
	$taskOptions = unserialize($assignment['taskOptions']);
	$taskOptions['taskRequirement']=cleanInput($pagePost['taskRequirement']);
	$taskOptionsSerialized = serialize($taskOptions);
	
	$sql = "UPDATE assignments SET closeUser='',closeDate='',claimUser='',claimDate='',taskStatus='0', createDate='$createDate', taskDesc='$taskDesc', taskPriority='$taskPriority', taskOptions='$taskOptionsSerialized' WHERE taskID='$pageID'";
	$result = dbQuery($sql) or die ("Query failed: reopenAssignment");
	
	addSuccessNotice("Assignment Opened");
}

?>