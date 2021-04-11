<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;
use function Mos\Functions\url;

$url = url("/yatzy/home/destroy");
$header = $header ?? null;
$message = $message ?? null;
$playerWins = $_SESSION["playerWins"] ?? 0;
$dataWins = $_SESSION["dataWins"] ?? 0;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?>

<h1><?= $header ?></h1>

<p><?= $message ?></p>



<form method="POST" action="<?= url("/yatzy/play") ?>">
<input type="hidden" id="start" name="start" value="start">
<button name="start" type="submit">Start game</button>



</form>


<p><button class="reset"><a class="reset" href="<?= $url ?>">Reset score</a></button></p>

<div class="scoreboard">
<h4>Score board.</h4>
<p><?= "Player: " . $playerWins ?></p>
<p><?= "Computer: " . $dataWins ?></p>
</div>
