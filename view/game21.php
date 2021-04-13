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
$numberOfDices = $numberOfDices ?? null;
$playerSum = $playerSum ?? null;

$graphicalDice = $graphicalDice ?? null;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p><?= $playerSum ?></p>

<p class="dice-utf8">

<?php if ($graphicalDice != null) : ?>
    <?php foreach ($graphicalDice as $value) : ?>
        <i class="dice"><?= $value ?></i>
    <?php endforeach; ?>
<?php endif; ?>
</p>



<form method="POST" action="<?= url("/game21/play") ?>">
<input type="hidden" id="dices" name="dices" value="<?= $numberOfDices ?>">
<button name="roll" type="submit" value="roll">Roll dices</button>
<button name="roll" type="submit" value="stop">Stop</button>
</form>

