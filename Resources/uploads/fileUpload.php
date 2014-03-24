<?php
// Harris Christiansen
// Created 2014-3-23

if(!(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))) {
	$saveDate = date('Y-m-d');
	$saveTime = date('H:i:s');
	$fileName = $saveDate.'.'.$saveTime.'.'.$_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"],$fileName);
    $uploadInfo = '[img width="480"]/Resources/uploads/'.$fileName.'[/img]';
}

?>

<script>
parent.window.sceditorInstance.insert('<? echo $uploadInfo; ?>');
</script>