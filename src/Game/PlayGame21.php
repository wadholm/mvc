<?php

declare(strict_types=1);

namespace Mack\Game;

use Mack\Dice\DiceHand;

use function Mos\Functions\{
    addDices
};

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };


/**
 * Class PlayGame21.
 */
class PlayGame21
{
    public $numberOfDices = 2;
    public $res;

    public function startGame()
    {
        if (isset($_POST["start"])) {
            $_SESSION["playerSum"] = 0;
            $_SESSION["dataSum"] = 0;
        }
    }

    public function getNumberOfDices()
    {
        return $this->numberOfDices = (int)$_POST["dices"];
    }

    public function playGame($roll)
    {
        if ($roll != null && $roll == "roll") {
            $this->res = $this->rollPlayer($_SESSION["playerSum"]);

            $_SESSION["playerSum"] = $this->res["playerSum"] ?? 0;
        } elseif ($roll != null && $roll == "stop") {
            $this->res = $this->rollComputer($_SESSION["playerSum"]);

            $_SESSION["dataSum"] = $this->res["dataSum"] ?? 0;
        }
        return $this->res;
    }

    public function rollPlayer($playerSum, $cheat = 0)
    {
        $diceHand = new DiceHand();
        $diceHand = addDices($diceHand, $this->numberOfDices);
        $diceHand->roll();

        $playerSum += $diceHand->sum();
        $this->res["playerSum"] = $playerSum;
        $this->res["graphicalDice"] = $diceHand->getGraphics();
        $this->res["result"] = "";
        if ((int)$playerSum == 21 || $cheat == 21) {
            $_SESSION["playerWins"] += 1;
            $_SESSION["playerWinner"] = true;
            $this->res["result"] = "Congratulations! You won, computer lost.";
        } elseif ((int)$playerSum > 21) {
            $_SESSION["dataWins"] += 1;
            $_SESSION["dataWinner"] = true;
            $this->res["result"] = "You lost, computer wins.";
        }
        return $this->res;
    }

    public function rollComputer($playerSum)
    {
        $diceHand = new DiceHand();
        $diceHand = addDices($diceHand, $this->numberOfDices);

        $dataSum = 0;
        while ($dataSum < $playerSum) {
            $diceHand->roll();
            $dataSum += $diceHand->sum();
        }

        if ($dataSum <= 21 && $dataSum >= $playerSum) {
            $_SESSION["dataWins"] += 1;
            $_SESSION["dataWinner"] = true;
            $this->res["result"] = "You lost, computer wins.";
            $this->res["dataSum"] = $dataSum;
            return $this->res;
        }
        $_SESSION["playerWins"] += 1;
        $_SESSION["playerWinner"] = true;
        $this->res["result"] = "Congratulations! You won, computer lost.";

        $this->res["dataSum"] = $dataSum;
        return $this->res;
    }
}
