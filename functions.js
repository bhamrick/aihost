function makegame(game) {
	if(window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4) {
			window.location=game+"/pages/display.php?game="+xmlhttp.responseText;
		}
	}
	var p1 = document.getElementById("player1");
	var p2 = document.getElementById("player2");
	p1 = p1.options[p1.selectedIndex].value;
	p2 = p2.options[p2.selectedIndex].value;
	document.getElementById("playbutton").innerHTML = "Playing...";
	document.getElementById("playbutton").disabled = "disabled";
	xmlhttp.open("GET",game+"/pages/play_game.php?p1="+p1+"&p2="+p2,true);
	xmlhttp.send(null);
}
