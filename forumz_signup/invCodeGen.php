<?php 
$mysqliServer="localhost";
$mysqliUser="forumzPublic";
$mysqliPass="forumzbb";
$mysqliDatabase="forumzPublicActs";
$con=@mysqli_connect($mysqliServer, $mysqliUser, $mysqliPass, $mysqliDatabase) or die ("Site Not Setup");

$chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
$invCode="";
for($i=0;$i<8;$i++) {
	$randNum=rand(0,63);
	$invCode=$invCode.$chars[$randNum];
}

if($_GET['secret']=="harriscforumz") {
	$sql = "INSERT INTO invCodes (invitationCode) VALUES ('$invCode')";
	$result = mysqli_query($con, $sql) or die ("Query failed: addInvCode");
}
?>