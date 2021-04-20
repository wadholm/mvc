<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Mack\Dice\DiceHand;
use Mack\Dice\GraphicalDice;

use function Mos\Functions\{
    destroySession,
    renderView,
    url,
    addDices
};

/**
 * Controller for the game21 route.
 */
class Game21
{
    public function home(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Game21",
            "title" => "Game21",
        ];
        // $numberOfDices = (int)$_POST["dices"];
        // $newGame = $_POST["start"] ?? null;

        // $_SESSION["playerSum"] = $_SESSION["playerSum"] ?? 0;
        $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;

        // $data["message"] = "You're playing with " . $numberOfDices . " dices. ";
        // $data["numberOfDices"] = $numberOfDices;
        // $data["playerSum"] = "Sum: " . $_SESSION["playerSum"];

        $body = renderView("layout/home21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/home"));
    }

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Game21",
            "title" => "Game21",
        ];

        if (isset($_POST["start"])) {
            $_SESSION["playerSum"] = 0;
            $_SESSION["dataSum"] = 0;
        }

        // $newGame = $_POST["start"] ?? null;
        // if ($newGame == "start") {
        //     $_SESSION["playerSum"] = 0;
        //     $_SESSION["dataSum"] = 0;
        // }
        // newGame();
        $numberOfDices = (int)$_POST["dices"];

        $_SESSION["playerSum"] = $_SESSION["playerSum"] ?? 0;
        $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;

        $data["message"] = "You're playing with " . $numberOfDices . " dices. ";
        $data["numberOfDices"] = $numberOfDices;
        $data["playerSum"] = "Sum: " . $_SESSION["playerSum"];



        $roll = $_POST["roll"] ?? null;
        if ($roll != null && $roll == "roll") {
            $diceHand = new DiceHand();
            $diceHand = addDices($diceHand, $numberOfDices);
            $diceHand->roll();

            $data["diceHandRoll"] = $diceHand->getLastRoll();
            $data["graphicalDice"] = $diceHand->getGraphics();

            $_SESSION["diceSumPlayer"] = $diceHand->sum();
            $_SESSION["playerSum"] += $diceHand->sum();
            $data["playerSum"] = "Player sum: " . $_SESSION["playerSum"];

            if ((int)$_SESSION["playerSum"] == 21) {
                $_SESSION["result"] = "Congratulations, you won!";
                $_SESSION["playerWins"] += 1;
                // redirectTo(url("/result21"));
                return (new Response())
                ->withStatus(301)
                ->withHeader("Location", url("/game21/result"));
            } elseif ((int)$_SESSION["playerSum"] > 21) {
                // echo "You lost";

                $_SESSION["result"] = "You lost, computer wins.";
                $_SESSION["dataWins"] += 1;
                // redirectTo(url("/result21"));
                return (new Response())
                ->withStatus(301)
                ->withHeader("Location", url("/game21/result"));
            }
        } elseif ($roll != null && $roll == "stop") {
            $diceHand = new DiceHand();
            $diceHand = addDices($diceHand, $numberOfDices);
            $diceHand->roll();

            $_SESSION["dataSum"] = 0;

            while ($_SESSION["dataSum"] < $_SESSION["playerSum"]) {
                $diceHand->roll();
                $_SESSION["dataSum"] += $diceHand->sum();
                $data["dataSum"] = "Data sum: " . $_SESSION["dataSum"];
            }
            if ($_SESSION["dataSum"] <= 21 && $_SESSION["dataSum"] >= $_SESSION["playerSum"]) {
                $_SESSION["result"] = "You lost, computer wins. ";
                $_SESSION["dataWins"] += 1;

                return (new Response())
                ->withStatus(301)
                ->withHeader("Location", url("/game21/result"));
            }
            $_SESSION["result"] = "Congratulations! You won, computer lost. ";
            $_SESSION["playerWins"] += 1;

            return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/result"));
        }
        $body = renderView("layout/game21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function result(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Game21",
            "title" => "Game21",
        ];

        $body = renderView("layout/result21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
