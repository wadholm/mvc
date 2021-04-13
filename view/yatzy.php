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
$histogram = $histogram ?? null;
$diceHand = $diceHand ?? null;
$numberOfDices = $numberOfDices ?? null;
$graphicalDice = $graphicalDice ?? null;
$rolls = $rolls ?? null;
$round = $round ?? null;
$diceRound = $diceRound ?? 1;
$graphics2rolls = $graphics2rolls ?? null;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?>

<div class="yatzy-div">
<h1><?= $header ?></h1>

<p><?= $message ?></p>

<p>Throw <?= $round ?></p>
<p>Roll for <?= $diceRound ?></p>

</div>
<form class="dice-form" method="POST" action="<?= url("/yatzy/play") ?>">
<?php if ($graphics2rolls != null) : ?>
    <?php $i = 0 ?>
    <?php foreach ($graphics2rolls as $roll) : ?>
        <input class="checkbox" type="checkbox" id="dice-<?= $i += 1 ?>" name="dice-<?= $i ?>" value="<?= $roll["value"] ?>">
        <label class="checkbox-graphics" for="dice-<?= $i ?>"><?= $roll["graphic"] ?></label><br>
    <?php endforeach; ?>

<?php endif; ?>
<input type="hidden" id="dices" name="dices" value="<?= $numberOfDices ?>">
<input type="hidden" id="round" name="round" value="<?= $round + 1 ?>">
<input type="hidden" id="diceround" name="diceround" value="<?= $diceRound ?>">
<?php if ($round < 3) : ?>
<button name="roll" type="submit" value="roll">Roll dices</button>
<?php elseif ($round == 3) : ?>
<button name="roll" type="submit" value="roll">Next</button>
<?php endif; ?>
</form> 