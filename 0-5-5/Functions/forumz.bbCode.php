<?
// Harris Christiansen
// Created 2013-11-16

// Misc Input
function cleanInput($input) {
	global $con;
	$fix[0]="<"; $fixed[0]="&lt;";
	$fix[1]=">"; $fixed[1]="&gt;";
	$fix[2]="'"; $fixed[2]="&#39;";
	$fix[3]='"'; $fixed[3]="&quot;";
	$output=str_replace($fix, $fixed, $input);
	$output = mysqli_real_escape_string($con, $output);
	$postFix[0]='\\&#39;'; $postFixed[0]="&#39;";
	$postFix[1]='\\&quot;'; $postFixed[1]="&quot;";
	$output=str_replace($postFix, $postFixed, $output);
	return $output;
}

// Posts
function formatPost($post) {
	$post = applyBBCode($post);
	$post = nl2br($post, false);
	return $post;
}

function applyBBCode($post) {
	// Primary security fixs
	$fix[0]="<"; $fixed[0]="&lt;";
	$fix[1]=">"; $fixed[1]="&gt;";
	$fix[2]="'"; $fixed[2]="&#39;";
	$fix[3]='"'; $fixed[3]="&quot;";
	$post=str_replace($fix, $fixed, $post);

	// Database Fixes
	$sql="SELECT * FROM bbCode ORDER BY orderNum";
	$result = dbQuery($sql) or die ("Query failed: applyBBCode");
	while($fix = mysqli_fetch_array($result)) {
		if(strpos($fix['before'],'value') !== false) { // contains a "value"
			preg_match('/\[(.*?)=([^\]]+)]/', $post, $match);
			if(strpos($fix['before'],$match[0]) !== false) { // contains searched value
				
			}
		} else { // Does not contain "value"
			$post=str_replace($fix['before'], $fix['after'], $post);
		}
	}
	return $post;
}

function reverseFormatPost($post) {
	$post=str_replace('<br>','',$post);
	$sql="SELECT * FROM bbCode ORDER BY orderNum DESC";
	$result = dbQuery($sql) or die ("Query failed: reverseFormatPost");
	while($fix = mysqli_fetch_array($result)) {
		$post=str_replace($fix['after'], $fix['before'], $post);
	}
	return $post;
}

?>