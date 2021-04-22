<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;
use function Mos\Functions\url;

$url = url("/yatzy/play");
$header = $header ?? null;
$message = $message ?? null;
$numberOfDices = 5;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?>

<h1><?= $header ?></h1>

<p><?= $message ?></p>



<form method="POST" action="<?= $url ?>">
<input type="hidden" id="start" name="start" value="start">
<input type="hidden" id="dices" name="dices" value="<?= $numberOfDices ?>">
<button name="start" type="submit">Start game</button>

</form>

<p><button class="reset"><a class="reset" href=<?= url("/yatzy/home/destroy") ?>>Reset score</a></button></p>

