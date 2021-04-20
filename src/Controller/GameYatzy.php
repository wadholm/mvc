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

        // newGame();
        $numberOfDices = 5;
        $checkedBoxes = 0;
        $dices = ["dice-1", "dice-2", "dice-3", "dice-4", "dice-5"];

        foreach ($dices as $dice) {
            if (isset($_POST[$dice]) && $_POST[$dice] == $_POST["diceround"]) {
                $checkedBoxes++;
            }
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
                    break;
                case 2:
                    $diceHand = new DiceHand();
                    $numberOfDices = $data["numberOfDices"] - $checkedBoxes;
                    $diceHand = addDices($diceHand, $numberOfDices);
                    $data["numberOfDices"] = $numberOfDices;
                    if ($numberOfDices != 0) {
                        $diceHand->roll();
                    }
                    $_SESSION["round-$diceRound"] = $_SESSION["round-$diceRound"] + $checkedBoxes;
                    for ($i = 0; $i < $checkedBoxes; $i++) {
                        $_SESSION["score"][] = $diceRound;
                    }
                    $data["graphics2rolls"] = $diceHand->getGraphics2Rolls();
                    break;
                case 3:
                    $diceHand = new DiceHand();
                    $numberOfDices = $data["numberOfDices"] - $checkedBoxes;
                    $diceHand = addDices($diceHand, $numberOfDices);
                    $data["numberOfDices"] = $numberOfDices;
                    if ($numberOfDices != 0) {
                        $diceHand->roll();
                    }
                    $_SESSION["round-$diceRound"] = $_SESSION["round-$diceRound"] + $checkedBoxes;
                    for ($i = 0; $i < $checkedBoxes; $i++) {
                        $_SESSION["score"][] = $diceRound;
                    }
                    $data["message"] = "Select dices to save. ";
                    $data["graphics2rolls"] = $diceHand->getGraphics2Rolls();
                    break;
                case 4:
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
