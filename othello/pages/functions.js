var board = [
[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 2, 1, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 1, 2, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ] ];

var dr = [-1, -1, -1, 0, 1, 1, 1, 0];
var dc = [-1, 0, 1, 1, 1, 0, -1, -1];

function update_display() {
	var whitescore=0, blackscore=0;
	for(var i = 1; i <= 8; i++) {
		for(var j = 1; j <= 8; j++) {
			if(board[i][j]==0) {
				document.getElementById("display"+i+j).src="/ai/othello/images/empty.png";
			} else if(board[i][j]==1) {
				document.getElementById("display"+i+j).src="/ai/othello/images/black.png";
				blackscore++;
			} else if(board[i][j]==2) {
				document.getElementById("display"+i+j).src="/ai/othello/images/white.png";
				whitescore++;
			}
		}
	}
	document.getElementById("blackscore").innerHTML=""+blackscore;
	document.getElementById("whitescore").innerHTML=""+whitescore;
}

function move(space, color) {
	var legal = false, r0 = Math.floor(space/10), c0 = space%10;
	if(space == 0 || board[r0][c0]!=0) return false;
	for(var d = 0; d<8; d++) {
		var r = r0+dr[d], c = c0+dc[d], good=true;
		if(board[r][c]!=3-color) {
			good=false;
		} else {
			while(board[r][c]==3-color) {
				r+=dr[d];
				c+=dc[d];
			}
			if(board[r][c]!=color) {
				good=false;
			}
		}
		if(good) {
			legal = true;
			r-=dr[d];
			c-=dc[d];
			while(r!=r0 || c!=c0) {
				board[r][c] = color;
				r-=dr[d];
				c-=dc[d];
			}
		}
	}
	if(legal) {
		board[r0][c0]=color;
	}
	return legal;
}

function forward() {
	if(game_moves && index < game_moves.length) {
		move(game_moves[index],index%2+1);
		index++;
	}
}

function backward() {
	if(game_moves && index > 0) {
		board = [
		[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 2, 1, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 1, 2, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
		[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ] ];
		var oldindex = index;
		for(index=0; index<oldindex-1; ) {
			forward();
		}
	}
}

function reset() {
	board = [
	[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 2, 1, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 1, 2, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 0, 0, 0, 0, 0, 0, 0, 0, 3 ],
	[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ] ];
	if(game_moves) index = 0;
}
