<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Mack\Dice\DiceHand;
use Mack\Game\PlayYatzy;

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

        $game = new PlayYatzy();
        $game->startGame();

        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "message" => "Play Yatzy.",
            "numberOfDices" => $_POST["dices"] ?? 0,
            "rollDices" => $_POST["rolldices"] ?? null,
            "roll" => $_POST["roll"] ?? 0,
            "round" => $_POST["round"] ?? 1
        ];

        $_SESSION["result"] = $_SESSION["result"] ?? null;
        $_SESSION["score"] = $_SESSION["score"] ?? null;


        $game->getSessionRounds();

        $res = $game->playGame($data["rollDices"], $data["round"], $data["roll"]);

        $data["message"] = $res["message"] ?? null;
        $data["graphics2rolls"] = $res["graphics2rolls"] ?? null;

        if (isset($res["numberOfDices"])) {
            $data["numberOfDices"] = $res["numberOfDices"];
        }

        if (isset($res["round"])) {
            $data["round"] = $res["round"];
        }

        if (isset($res["roll"])) {
            $data["roll"] = $res["roll"];
        }

        if (isset($_SESSION["result"])) {
            $_SESSION["result"] = printHistogram($_SESSION["score"]);
            return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/result"));
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
            "bonus" => false,
            "score" => $_SESSION["score"] ?? null,
            "totalScore" => 0,
            "bonusScore" => 50
        ];

        $game = new PlayYatzy();

        $data["totalScore"] = $game->calculateTotalScore($data["score"]);
        $data["bonus"] = $game->checkForBonus();

        $body = renderView("layout/resultYatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
