<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;
use function Mos\Functions\url;

$url = url("/home21");

$header = $header ?? null;
$result = $_SESSION["result"] ?? null;

$playerSum = $_SESSION["playerSum"] ?? null;
$dataSum = $_SESSION["dataSum"] ?? null;

$playerWins = $_SESSION["playerWins"] ?? null;
$dataWins = $_SESSION["dataWins"] ?? null;



// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?><h1><?= $header ?></h1>

<p><?= $result ?></p>

<p><?= "You rolled " . $playerSum . "."?></p>

<?php if ($dataSum != null) : ?>
<p><?= "Computer rolled " . $dataSum . "."?></p>
<?php endif; ?>

<p><button class="play"><a class="play" href="<?= $url ?>">Play again?</a></button></p>

<div class="scoreboard">
<h4>Score board.</h4>
<p><?= "Player: " . $playerWins ?></p>
<p><?= "Computer: " . $dataWins ?></p>
</div>
