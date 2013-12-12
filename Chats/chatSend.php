<?
session_name("forumzDev");
session_start();
$userData=$_SESSION['userData'];
if($userData['permissions']['useChat']=="true"){  
    $text = stripslashes(htmlspecialchars($_POST['text']));
    $text = str_replace("\n","",$text);
    $username = $userData['username'];
    
    if($text=="-clear-") {
    	file_put_contents("siteChat.html", "");
    } else {
    	$fp = fopen("siteChat.html", 'a');
		fwrite($fp, '<div class="chatWindowMsg"><div class="chatWindowMsgSender">'.$username.': </div>'.$text.'</div>'."\n");
		fclose($fp);
	}
} else {
	echo "Permission Denied";
}
?>