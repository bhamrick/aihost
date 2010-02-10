#!/usr/bin/python
from subprocess import *
import sys
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
[ 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 ] ]
dr = [-1,-1,-1,0,1,1,1,0]
dc = [-1,0,1,1,1,0,-1,-1]

def legal(space, player):
	global board, dr, dc
	r0 = space/10
	c0 = space%10
	if(board[r0][c0]!=0):
		return False
	for d in range(8):
		good = True
		r = r0+dr[d]
		c = c0+dc[d]
		if(board[r][c]!=3-player):
			good = False
		else:
			while(board[r][c]==3-player):
				r+=dr[d]
				c+=dc[d]
			if(board[r][c]!=player):
				good=False
		if(good):
			return True
	return False

def canmove(player):
	global board
	for space in range(100):
		if(legal(space,player)):
			return True
	return False

def move(space, player):
	global board, dr, dc
	r0 = space/10
	c0 = space%10
	if(board[r0][c0]!=0):
		return 
	for d in range(8):
		good = True
		r = r0+dr[d]
		c = c0+dc[d]
		if(board[r][c]!=3-player):
			good = False
		else:
			while(board[r][c]==3-player):
				r+=dr[d]
				c+=dc[d]
			if(board[r][c]!=player):
				good=False
		if(good):
			r-=dr[d]
			c-=dc[d]
			while(r!=r0 or c!=c0):
				board[r][c] = player
				r-=dr[d]
				c-=dc[d]
	board[r0][c0] = player

prefix = "/www/ai/othello";
player1 = prefix + "/ais/ai" + sys.argv[1]
player2 = prefix + "/ais/ai" + sys.argv[2]

p = [False,Popen(player1, shell=True, stdin=PIPE, stdout=PIPE, stderr=PIPE),Popen(player2, shell=True, stdin=PIPE, stdout=PIPE, stderr=PIPE)]

p[1].stdin.write('Start\n')
turn = 1
record = ""
while(canmove(1) or canmove(2)):
	if(not canmove(turn)):
		turn = 3-turn
		record = record + " 00"
	mv = p[turn].stdout.readline()[:-1]
	record = record + " " + mv
	p[3-turn].stdin.write(mv+'\n')
	mv = int(mv)
	move(mv,turn)
	turn = 3-turn

p[1].stdin.write('Quit\n')
p[2].stdin.write('Quit\n')

blacks = 0
whites = 0
empties = 0
for row in board:
	for space in row:
		if space == 0:
			empties = empties+1
		elif space == 1:
			blacks = blacks+1
		elif space == 2:
			whites = whites+1

print record[1:]
if blacks == whites:
	print 32
elif blacks > whites:
	print blacks + empties
else:
	print blacks
