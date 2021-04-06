<?php

declare(strict_types=1);

namespace Mack\Dice;

use Mack\Dice\Dice;
use Mack\Dice\DiceHand;
use Mack\Dice\GraphicalDice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game.
 */
class Game21
{
    public function playGame(): void
    {
        $data = [
            "header" => "Game21",
            "title" => "Game21",
            // "message" => "Hey, this is your dice-game!",
        ];

        $numberOfDices = (int)$_POST["dices"];
        // $newGame = $_POST["start"] ?? null;

        $_SESSION["playerSum"] = $_SESSION["playerSum"] ?? 0;
        $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;

        $data["message"] = "You're playing with " . $numberOfDices . " dices. ";
        $data["numberOfDices"] = $numberOfDices;
        $data["playerSum"] = "Sum: " . $_SESSION["playerSum"];


        $roll = $_POST["roll"] ?? null;
        if ($roll != null && $roll == "roll") {
            // echo "Roll";
            // var_dump($roll);
            $diceHand = new DiceHand($numberOfDices);
            $diceHand->roll();

            $data["diceHandRoll"] = $diceHand->getLastRoll();
            $data["graphicalDice"] = $diceHand->getGraphics();

            $_SESSION["diceSumPlayer"] = $diceHand->sum();
            $_SESSION["playerSum"] += $diceHand->sum();
            $data["playerSum"] = "Player sum: " . $_SESSION["playerSum"];
            $body = renderView("layout/game21.php", $data);
            sendResponse($body);
            if ($_SESSION["playerSum"] == 21) {
                // echo "You rolled 21, congratulations!";

                $_SESSION["result"] = "Congratulations, you won!";
                $_SESSION["playerWins"] += 1;
                redirectTo(url("/result21"));
            } elseif ($_SESSION["playerSum"] > 21) {
                // echo "You lost";

                $_SESSION["result"] = "You lost, computer wins.";
                $_SESSION["dataWins"] += 1;
                redirectTo(url("/result21"));
            }
            return;
        } elseif ($roll != null && $roll == "stop") {
            // echo "Stop";
            // var_dump($roll);
            $diceHand = new DiceHand($numberOfDices);
            // $diceHand->roll();

            // $data["diceHandRoll"] = $diceHand->getLastRoll();
            // $data["graphicalDice"] = $diceHand->getGraphics();

            $_SESSION["dataSum"] = 0;
            // echo $_SESSION["dataSum"];
            // echo $_SESSION["playerSum"];
            while ($_SESSION["dataSum"] < $_SESSION["playerSum"]) {
                $diceHand->roll();
                $_SESSION["dataSum"] += $diceHand->sum();
                $data["dataSum"] = "Data sum: " . $_SESSION["dataSum"];
            }
            if ($_SESSION["dataSum"] <= 21 && $_SESSION["dataSum"] >= $_SESSION["playerSum"]) {
                // echo "computer wins" ;
                // echo $_SESSION["dataSum"];
                $_SESSION["result"] = "You lost, computer wins. ";
                $_SESSION["dataWins"] += 1;
                redirectTo(url("/result21"));
                return;
            }
            // echo "player wins";
            // echo $_SESSION["playerSum"];
            $_SESSION["result"] = "Congratulations! You won, computer lost. ";
            $_SESSION["playerWins"] += 1;
            redirectTo(url("/result21"));

            // echo "data" . $_SESSION["dataSum"];
            // echo "player" . $_SESSION["playerSum"];
            // $_SESSION["diceSumData"] = $diceHand->sum();
            // $_SESSION["dataSum"] += $diceHand->sum();
            // $data["dataSum"] = "Sum: " . $_SESSION["dataSum"];
            return;
        }
        $body = renderView("layout/game21.php", $data);
        sendResponse($body);

    }
}
