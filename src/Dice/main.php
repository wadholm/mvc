<?php

declare(strict_types=1);

// Get the autoloader
require __DIR__ . "/../../vendor/autoload.php";

use Mack\Dice\GraphicalDice;

$die = new GraphicalDice();

// for ($i = 0; $i < 9; $i++) {
//     $die->roll();
//     echo $die->getLastRoll() . ", ";
// }

$die->roll();
echo $die->graphic();
