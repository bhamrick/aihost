<?php
include_once("globals.php");
$p1 = $_GET["p1"];
$p2 = $_GET["p2"];
unset($output);
$command = "$REFEREE $p1 $p2";
exec($command,$output);
$record = $output[0];
$result = $output[1];
$query = "INSERT INTO othello_games VALUES (0,$p1,$p2,'$record',$result)";
mysql_query($query);
$gameid = mysql_insert_id();
echo $gameid;
?>
