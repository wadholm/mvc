Start game
Present menu to user
IF user resets score
	THEN reset score
ELSEIF user starts game
	THEN start game
Initiate new game of six dicerounds
Start round
CASE based on round
CASE round 1
	Create new hand
	Add five dices to hand
	Roll dices
	Present rolled dices with graphics
	Save choosen dices
CASE round 2
	Create new hand
	Add five dices minus saved dices to hand
	Roll dices
	Present rolled dices with graphics
	Save choosen dices
CASE round 3
	Create new hand
	Add dices from round 2 minus saved dices to hand
	Roll dices
	Present rolled dices with graphics
	Save choosen dices
CASE round 4
	Present rolled dices
	Save score
	Set diceround plus 1
	Reset round to 0
	IF diceround is greater than 6
		THEN PRESENT result