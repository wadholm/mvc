<?php

declare(strict_types=1);

namespace Mack\Dice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

use Mack\Dice\Dice;
use Mack\Dice\DiceHand;

/**
 * Class Game.
 */
class Game
{
    public function playGame(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Hey, this is your dice-game!",
        ];

        $die = new Dice();
        $diceHand = new DiceHand();
        
        $die->roll();
        $diceHand->roll();

        $data["dieLastRoll"] = $die->getLastRoll();
        $data["diceHandRoll"] = $diceHand->getLastRoll();

        $diceHand->roll();
        $data["diceHandRoll2"] = $diceHand->getLastRoll();

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

}
