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
$result = $_SESSION["result"] ?? null;
$score = $_SESSION["score"] ?? null;
$totalScore = $data["totalScore"] ?? null;
$bonus = $data["bonus"] ?? null;




// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?><h1><?= $header ?></h1>

<p><button class="play"><a class="play" href="<?= $url ?>">Play again?</a></button></p>

<div class="scoreboard">
<h4>Score board.</h4>
<p><?= $result ?></p>
<p>Sum: <?= $totalScore ?></p>
<?php if ($bonus == true) : ?>
    <p>Bonus: <?= $bonus ?></p>
    <p><?php $totalScore += $bonus?></p>
    <p>Total: <?= $totalScore ?></p>
<?php endif; ?>
</div>