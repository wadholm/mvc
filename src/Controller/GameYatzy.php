<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Mack\Dice\DiceHand;

use function Mos\Functions\{
    destroySession,
    renderView,
    url,
    newGame,
    addDices,
    printHistogram
};

/**
 * Controller for the gameYatzy route.
 */
class GameYatzy
{
    public function home(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
        ];
        // $numberOfDices = (int)$_POST["dices"];
        // $newGame = $_POST["start"] ?? null;

        // $_SESSION["playerSum"] = $_SESSION["playerSum"] ?? 0;
        $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;

        // $data["message"] = "You're playing with " . $numberOfDices . " dices. ";
        // $data["numberOfDices"] = $numberOfDices;
        // $data["playerSum"] = "Sum: " . $_SESSION["playerSum"];

        $body = renderView("layout/homeYatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/home"));
    }

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
        ];

        newGame();
        $numberOfDices = 5;
        $checkedBoxes = 0;

        if (isset($_POST["dice-1"]) && $_POST["dice-1"] == $_POST["diceround"]) {
            $checkedBoxes++;
        }
        if (isset($_POST["dice-2"]) && $_POST["dice-2"] == $_POST["diceround"]) {
            $checkedBoxes++;
        }
        if (isset($_POST["dice-3"]) && $_POST["dice-3"] == $_POST["diceround"]) {
            $checkedBoxes++;
        }
        if (isset($_POST["dice-4"]) && $_POST["dice-4"] == $_POST["diceround"]) {
            $checkedBoxes++;
        }
        if (isset($_POST["dice-5"]) && $_POST["dice-5"] == $_POST["diceround"]) {
            $checkedBoxes++;
        }

        $data["message"] = "Play Yatzy. ";
        $_SESSION["result"] = $_SESSION["result"] ?? null;
        $data["numberOfDices"] = $_POST["dices"] ?? 0;
        $data["round"] = $_POST["round"] ?? 0;
        $data["diceRound"] = $_POST["diceround"] ?? 1;
        $diceRound = $_POST["diceround"] ?? 0;

        // create round to store score 1-6
        $rounds = ["round-1", "round-2", "round-3", "round-4", "round-5", "round-6"];
        $_SESSION["score"] = $_SESSION["score"] ?? null;
        foreach ($rounds as $round) {
            $_SESSION[$round] = $_SESSION[$round] ?? 0;
        }
        // $_SESSION["round-1"] = $_SESSION["round-1"] ?? 0;
        // $_SESSION["round-2"] = $_SESSION["round-2"] ?? 0;
        // $_SESSION["round-3"] = $_SESSION["round-3"] ?? 0;
        // $_SESSION["round-4"] = $_SESSION["round-4"] ?? 0;
        // $_SESSION["round-5"] = $_SESSION["round-5"] ?? 0;
        // $_SESSION["round-6"] = $_SESSION["round-6"] ?? 0;

        $roll = $_POST["roll"] ?? null;

        if ($roll != null && $roll == "roll") {
            switch ($data["round"]) {
                case 1:
                    $diceHand = new DiceHand();
                    $diceHand = addDices($diceHand, $numberOfDices);
                    $data["numberOfDices"] = $numberOfDices;
                    $diceHand->roll();
                    $data["message"] = "Select dices to save, then roll again. ";
                    $data["graphics2rolls"] = $diceHand->getGraphics2Rolls();
                    $data["histogram"] = $diceHand->printHistogram();
                    break;
                case 2:
                    $diceHand = new DiceHand();
                    $numberOfDices = $data["numberOfDices"] - $checkedBoxes;
                    $diceHand = addDices($diceHand, $numberOfDices);
                    $data["numberOfDices"] = $numberOfDices;
                    if ($numberOfDices != 0) {
                        $diceHand->roll();
                    }
                    // add dices
                    $_SESSION["round-$diceRound"] = $_SESSION["round-$diceRound"] + $checkedBoxes;
                    for ($i = 0; $i < $checkedBoxes; $i++) {
                        $_SESSION["score"][] = $diceRound;
                    }
                    $data["message"] = "Select dices to save, then roll again. ";
                    $data["graphics2rolls"] = $diceHand->getGraphics2Rolls();
                    $data["histogram"] = $diceHand->printHistogram();
                    break;
                case 3:
                    $diceHand = new DiceHand();
                    $numberOfDices = $data["numberOfDices"] - $checkedBoxes;
                    $diceHand = addDices($diceHand, $numberOfDices);
                    $data["numberOfDices"] = $numberOfDices;
                    if ($numberOfDices != 0) {
                        $diceHand->roll();
                    }
                    // add dices
                    $_SESSION["round-$diceRound"] = $_SESSION["round-$diceRound"] + $checkedBoxes;
                    for ($i = 0; $i < $checkedBoxes; $i++) {
                        $_SESSION["score"][] = $diceRound;
                    }
                    $data["message"] = "Select dices to save. ";
                    $data["graphics2rolls"] = $diceHand->getGraphics2Rolls();
                    $data["histogram"] = $diceHand->printHistogram();
                    break;
                case 4:
                    // add dices
                    $_SESSION["round-$diceRound"] = $_SESSION["round-$diceRound"] + $checkedBoxes;
                    for ($i = 0; $i < $checkedBoxes; $i++) {
                        $_SESSION["score"][] = $diceRound;
                    }
                    $data["message"] = "You rolled " . $_SESSION["round-$diceRound"] . " dices with the value of " . $diceRound . ".";
                    $data["diceRound"] = $diceRound + 1;
                    $data["round"] = 0;
                    if ($data["diceRound"] > 6) {
                        $_SESSION["result"] = printHistogram($_SESSION["score"]);
                        return (new Response())
                        ->withStatus(301)
                        ->withHeader("Location", url("/yatzy/result"));
                    }
                    break;
            }
        }

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function result(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
        ];
        $score = $_SESSION["score"] ?? null;
        $data["bonus"] = $data["bonus"] ?? false;

        $totalScore = 0;
        $bonus = 50;
        if ($score != null) {
            foreach ($score as $value) {
                $totalScore += $value;
            }
        }

        $rounds = ["round-1", "round-2", "round-3", "round-4", "round-5", "round-6"];
        $_SESSION["score"] = $_SESSION["score"] ?? null;
        $bonusflag = 0;
        foreach ($rounds as $round) {
            if ($_SESSION[$round] >= 3) {
                $bonusflag += 1;
            }
        }

        if ($totalScore >= 63 && $bonusflag == 6) {
            $data["bonus"] = true;
            // $totalScore += $bonus;
        }
        $data["totalScore"] = $totalScore ?? 0;
        $data["bonusScore"] = $bonus ?? 0;

        $body = renderView("layout/resultYatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
