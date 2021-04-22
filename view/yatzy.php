<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;
use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;
$yatzy = $_SESSION["yatzy"] ?? null;
$diceHand = $diceHand ?? null;
$numberOfDices = $numberOfDices ?? null;
$graphicalDice = $graphicalDice ?? null;
// $rolleds = $rolleds ?? null;
$roll = $roll ?? null;
$round = $round ?? 1;
$graphics2rolls = $graphics2rolls ?? null;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?>

<div class="yatzy-div">
<h1><?= $header ?></h1>

<p><?= $yatzy ?></p>

<p><?= $message ?></p>

<p>Throw <?= $roll ?></p>
<p>Roll for <?= $round ?></p>

</div>
<form class="dice-form" method="POST" action="<?= url("/yatzy/play") ?>">
<?php if ($graphics2rolls != null) : ?>
    <?php $i = 0 ?>
    <?php foreach ($graphics2rolls as $rolled) : ?>
        <input class="checkbox" type="checkbox" id="dice-<?= $i += 1 ?>" name="dice-<?= $i ?>" value="<?= $rolled["value"] ?>">
        <label class="checkbox-graphics" for="dice-<?= $i ?>"><?= $rolled["graphic"] ?></label><br>
    <?php endforeach; ?>

<?php endif; ?>
<input type="hidden" id="dices" name="dices" value="<?= $numberOfDices ?>">
<input type="hidden" id="roll" name="roll" value="<?= $roll + 1 ?>">
<input type="hidden" id="round" name="round" value="<?= $round ?>">
<?php if ($roll < 3) : ?>
<button name="rolldices" type="submit" value="rolldices">Roll dices</button>
<?php elseif ($roll == 3) : ?>
<button name="rolldices" type="submit" value="rolldices">Next</button>
<?php endif; ?>
</form> 