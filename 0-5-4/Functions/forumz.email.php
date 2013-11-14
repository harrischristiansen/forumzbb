<?php
// Harris Christiansen
// Created 10-4-13

function sendEmail($emailTarget, $msgSubject, $msg) {
	$siteName = getSiteName();
	if(!isEmailValid($emailTarget)) {
		addFailureNotice("Invalid Email Address");
		return false;
	}
	
	// Send Email
	$subject = 'Forumzbb - '.$siteName.' - '.$subject;
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Forumzbb-'.$siteName.' <'.$siteName.'@forumzbb.com>';
	$headers .= "\r\n".'Reply-To: replyTo@forumzbb.com';
	$message = '
		<html><head>
			<title>'.$subject.'</title>
		</head><body>
			'.$msg.'
		</body></html>';
	mail($emailTarget, $subject, $message, $headers);
}
?>