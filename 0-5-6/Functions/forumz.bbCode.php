<?
// Harris Christiansen
// Created 2013-11-16

include($_SERVER['DOCUMENT_ROOT'].'/Resources/plugins/jbbcode/Parser.php');

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
	
	// BB Code Parser
	$parser = new JBBCode\Parser();
	
	// Add Definitions
	$sql="SELECT * FROM bbCode WHERE idNum>'0'";
	$result = dbQuery($sql) or die ("Query failed: applyBBCode");
	while($fix = mysqli_fetch_array($result)) {
		$builder = new JBBCode\CodeDefinitionBuilder($fix['bbCode'], $fix['htmlCode']);
		if($fix['useOption']=="true") { $builder->setUseOption(true); }
		$parser->addCodeDefinition($builder->build());
	}
 
	$parser->parse($post);
 
	return $parser->getAsHtml();
}

?>