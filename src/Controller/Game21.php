<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Mack\Dice\DiceHand;
use Mack\Dice\GraphicalDice;
use Mack\Game\PlayGame21;

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

        $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;
        $_SESSION["playerWinner"] = false;
        $_SESSION["dataWinner"] = false;
        $_SESSION["result"] = null;

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

        $game = new PlayGame21();
        $game->startGame();
        $numberOfDices  = $game->getNumberOfDices();

        $data = [
            "header" => "Game21",
            "title" => "Game21",
            "message" => "You're playing with " . $numberOfDices . " dices.",
            "numberOfDices" => $numberOfDices,
            "playerSum" => $_SESSION["playerSum"],
        ];

        $roll = $_POST["roll"] ?? null;
        $res = $game->playGame($roll);

        $data["graphicalDice"] = $res["graphicalDice"] ?? 0;
        $data["playerSum"] = $_SESSION["playerSum"];

        if ($_SESSION["playerWinner"] == true || $_SESSION["dataWinner"] == true) {
            $_SESSION["result"] = $res["result"];

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
