<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;

$header = $header ?? null;
$message = $message ?? null;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p> DICE!!! </p> 

<p><?= $dieLastRoll ?></p>

<p> DiceHand! </p> 

<p><?= $diceHandRoll ?></p>
<p><?= $diceHandRoll2 ?></p>
