<?
// Harris Christiansen
// Created 2013-11-16

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
		$post=str_replace($fix['before'], $fix['after'], $post);
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