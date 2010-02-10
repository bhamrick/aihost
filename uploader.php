<?php
include_once("globals.php");
if(isset($_FILES['ai'])) {
	$query = "INSERT INTO othello_ai VALUES (0,0,'".basename($_FILES['ai']['name'])."')";
	$result = mysql_query($query);
	$id = mysql_insert_id();
	$target = "othello/ais/ai$id";
	if(move_uploaded_file($_FILES['ai']['tmp_name'],$target)) {
		chmod($target,0755);
		header("Location:index.php");
	} else {
		header("Location:upload.php");
	}
} else {
	header("Location:upload.php");
}
?>
