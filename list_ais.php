<?php
include_once("globals.php");
echo "<script type=\"text/javascript\" src=\"functions.js\"></script>\n";
if(!isset($_GET["game"])) {
	echo "Error: No game selected<br/>\n";
} else {
	echo "<div id=\"ailist\">\n";
	$game = $_GET["game"];
	$query = "SELECT * FROM " . $game . "_ai WHERE Owner!=0";
	$result = mysql_query($query);
	$nrows = mysql_num_rows($result);
	echo "<table>\n";
	echo "\t<tr>\n";
	echo "\t\t<th>ID</th>\n";
	echo "\t\t<th>Owner</th>\n";
	echo "\t\t<th>Name</th>\n";
	for($i = 0; $i<$nrows; $i++) {
		echo "\t<tr>\n";
		$id = mysql_result($result,$i,"ID");
		$owner = mysql_result($result,$i,"Owner");
		if($owner == 0) {
			$owner = "N/A";
		} else {
			$owner = mysql_result(mysql_query("SELECT * FROM users WHERE ID=$owner"),0,"Name");
		}
		$name = mysql_result($result,$i,"Name");
		echo "\t\t<td>$id</td>\n";
		echo "\t\t<td>$owner</td>\n";
		echo "\t\t<td>$name</td>\n";
		echo "\t</tr>\n";
	}
	echo "</table>\n";
	echo "</div>";
	echo "<div id=\"gamemaker\">\n";
	echo "Black Player:\n<select id=\"player1\">\n";
	for($i = 0; $i<$nrows; $i++) {
		$id = mysql_result($result,$i,"ID");
		$name = mysql_result($result,$i,"Name");
		echo "\t<option value=\"$id\">$id - $name</option>\n";
	}
	echo "</select><br />\n";
	echo "White Player:\n<select id=\"player2\">\n";
	for($i = 0; $i<$nrows; $i++) {
		$id = mysql_result($result,$i,"ID");
		$name = mysql_result($result,$i,"Name");
		echo "\t<option value=\"$id\">$id - $name</option>\n";
	}
	echo "</select><br />\n";
	echo "<button id=\"playbutton\" onclick=\"makegame('$game');\">Play a Game</button>\n";
	echo "<button onclick=\"findgames('$game');\">Find Games</button>\n";
	echo "</div>\n";
}
?>
