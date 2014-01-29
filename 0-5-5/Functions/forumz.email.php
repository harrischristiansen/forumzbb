<?php
// Harris Christiansen
// Created 10-4-13

function sendEmail($emailTarget, $msgSubject, $msg) {
	$siteName = getSiteName();
	$siteAddress = getSiteAddress();
	if(!isEmailValid($emailTarget)) {
		addFailureNotice("Invalid Email Address");
		return false;
	}
	
	// Send Email
	$subject = $siteName.' - Hosted By Forumzbb - '.$msgSubject;
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: "'.$siteName.'"<'.$siteName.'@'.$siteAddress.'>'."\r\n";
	$headers .= 'Reply-To: replyTo@'.$siteAddress.'';
	$message = '
		<html><head>
			<title>'.$subject.'</title>
		</head><body>
			'.$msg.'
			<br><br>
			<p>
			'.$siteName.' - <a href="http://'.$siteAddress.'">'.$siteAddress.'</a><br>
			This site is powered by ForumzBB - <a href="http://www.forumzbb.com">www.forumzbb.com</a>
			</p>
		</body></html>';
	mail($emailTarget, $subject, $message, $headers);
}
?>