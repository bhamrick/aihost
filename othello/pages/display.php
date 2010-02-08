<link rel="stylesheet" type="text/css" href="/ai/othello/pages/style.css" />
<script type="text/javascript" src="/ai/othello/pages/functions.js"></script>
<div id="display">
<?php
include_once("../../globals.php");
if(isset($_GET["game"])) {
	$result = mysql_query("SELECT * FROM othello_games WHERE ID=$_GET[game]");
	$moves = mysql_result($result,0,"Moves");
	$player1 = mysql_result($result,0,"Player1");
	$player2 = mysql_result($result,0,"Player2");
	if($player1==0) {
		$player1 = "Human";
	} else {
		$res = mysql_query("SELECT * FROM othello_ai WHERE ID=$player1");
		$player1 = mysql_result($res,0,"Name");
	}
	if($player2==0) {
		$player2 = "Human";
	} else {
		$res = mysql_query("SELECT * FROM othello_ai WHERE ID=$player2");
		$player2 = mysql_result($res,0,"Name");
	}
} else if(isset($_GET["moves"])) {
	$moves = $_GET["moves"];
}
if(isset($moves)) {
echo "
<script type=\"text/javascript\">
var game_moves = [".implode(", ",explode(" ",$moves))."], index=0;
</script>
";
}

$board = array(
array( 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 2, 1, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 1, 2, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ),
array( 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ) );

if(isset($player1) and isset($player2)) {
	echo "$player1 (Black) vs $player2 (White)";
}
echo "<table>\n";
for($i = 1; $i<=8; $i++) {
	echo "\t<tr>\n";
	for($j = 1; $j<=8; $j++) {
		if($board[$i][$j]==0) {
			echo "\t\t<td><img id=\"display$i$j\" src=\"/ai/othello/images/empty.png\" /></td>\n";
		} else if($board[$i][$j]==1) {
			echo "\t\t<td><img id=\"display$i$j\" src=\"/ai/othello/images/black.png\" /></td>\n";
		} else if($board[$i][$j]==2) {
			echo "\t\t<td><img id=\"display$i$j\" src=\"/ai/othello/images/white.png\" /></td>\n";
		}
	}
	echo "\t</tr>\n";
}
echo "</table>\n";
?>
<button id="backward" onclick="backward(); update_display();">&lt;</button>
<button id="forward" onclick="forward(); update_display();">&gt;</button>
<button id="reset" onclick="reset(); update_display();">Reset</button>
Black: <span id="blackscore">2</span> White: <span id="whitescore">2</span>
</div>
