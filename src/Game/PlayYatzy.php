<?php

declare(strict_types=1);

namespace Mack\Game;

use Mack\Dice\DiceHand;

use function Mos\Functions\{
    addDices,
    printHistogram
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
 * Class PlayYatzy.
 */
class PlayYatzy
{
    public $numberOfDices = 5;
    public $checkedBoxes;
    public $res;
    public $bonus = false;
    public $dices = [
        "dice-1",
        "dice-2",
        "dice-3",
        "dice-4",
        "dice-5"
    ];
    public $rounds = [
        "round-1",
        "round-2",
        "round-3",
        "round-4",
        "round-5",
        "round-6"
    ];

    public function startGame()
    {
        if (isset($_POST["start"])) {
            $_SESSION["result"] = null;
            $_SESSION["score"] = null;
            $this->resetSessionRounds();
            return true;
        }
        return false;
    }

    public function getFirstNumberOfDices()
    {
        $this->numberOfDices = 5;
        return $this->numberOfDices;
    }

    public function getNumberOfDices()
    {
        $this->numberOfDices = (int)$_POST["dices"] ?? 0;
        return $this->numberOfDices;
    }

    public function getCheckedBoxes()
    {
        foreach ($this->dices as $dice) {
            if (isset($_POST[$dice]) && $_POST[$dice] == $_POST["round"]) {
                $this->checkedBoxes++;
            }
        }
    }

    public function getSessionRounds()
    {
        foreach ($this->rounds as $round) {
            $_SESSION[$round] = $_SESSION[$round] ?? 0;
        }
    }

    public function resetSessionRounds()
    {
        foreach ($this->rounds as $round) {
            $_SESSION[$round] = 0;
        }
    }

    public function addScore($round)
    {
        for ($i = 0; $i < $this->checkedBoxes; $i++) {
            $_SESSION["score"][] = $round;
        }
    }

    public function getMessage($round, $roll)
    {
        $this->res["message"] = "Select dices to save, then roll again.";

        if ($roll == 3) {
            $this->res["message"] = "Select dices to save.";
        } elseif ($roll == 4) {
            $this->res["message"] = "You rolled " . $_SESSION["round-$round"] . " dices with the value of " . $round . ".";
        }
        return $this->res["message"];
    }

    public function playGame($rollDices, $round, $roll)
    {
        if ($rollDices != null && $rollDices == "rolldices") {
            $this->getCheckedBoxes();
            $this->numberOfDices = $this->getNumberOfDices() - $this->checkedBoxes;
            $this->res = $this->rollDices($round, $roll);
            return $this->res;
        }
    }

    public function rollDices($round, $roll)
    {
        $diceHand = new DiceHand();
        if ($roll == 1) {
            $this->numberOfDices = $this->getFirstNumberOfDices();
        }

        $diceHand = addDices($diceHand, $this->numberOfDices);
        $this->res["numberOfDices"] = $this->numberOfDices;

        if ($this->numberOfDices != 0) {
            $diceHand->roll();
        }

        $_SESSION["round-$round"] = $_SESSION["round-$round"] + $this->checkedBoxes;

        if ((int)$_SESSION["round-$round"] == 5) {
            $_SESSION["yatzy"] = "You rolled Yatzy!!";
            $roll = 4;
        }

        $this->addScore($round);

        $this->res["graphics2rolls"] = $diceHand->getGraphics2Rolls();
        $this->res["message"] = $this->getMessage($round, $roll);

        if ($roll == 4) {
            $this->res["round"] = $round + 1;
            $this->res["roll"] = 0;
            $this->res["graphics2rolls"] = null;
            if ($this->res["round"] > 6) {
                $_SESSION["result"] = printHistogram($_SESSION["score"]);
            }
        }
        return $this->res;
    }

    public function calculateTotalScore($score)
    {
        $this->res["totalScore"] = 0;
        if ($score != null) {
            foreach ($score as $value) {
                $this->res["totalScore"] += $value;
            }
            return $this->res["totalScore"];
        }
    }

    public function checkForBonus()
    {
        $bonusflag = 0;
        foreach ($this->rounds as $round) {
            if ($_SESSION[$round] >= 3) {
                $bonusflag += 1;
            }
        }
        if ($this->res["totalScore"] >= 63 && $bonusflag == 6) {
            $this->bonus = true;
        }
        return $this->bonus;
    }
}
