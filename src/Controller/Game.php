<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Mack\Dice\Dice;
use Mack\Dice\DiceHand;

use function Mos\Functions\renderView;

/**
 * Controller for the game route.
 */
class Game
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Dice",
            "message" => "Hey, this is your dice-game!",
        ];


        $die = new Dice();
        $diceHand = new DiceHand();
        // $graphicalDie = new GraphicalDice();
        // $rolls = 2;

        $die->roll();
        $diceHand->roll();


        $data["dieLastRoll"] = $die->getLastRoll();
        $data["diceHandRoll"] = $diceHand->getLastRoll();

        $_SESSION["diceSumData"] = $diceHand->sum();
        // $_SESSION["dataSum"] = $_SESSION["dataSum"] + $diceHand->sum() ?? 0;

        // $data["graphicalDice"] = [];

        // for ($i = 0; $i < $rolls; $i++) {
        //     $graphicalDie->roll();
        //     $data["graphicalDice"][$i] = $graphicalDie->graphic();
        //     // var_dump($data["graphicalDice"]);
        // }

        $diceHand->roll();
        $data["diceHandRoll2"] = $diceHand->getLastRoll();
        $data["graphicalDice"] = $diceHand->getGraphics();
        // var_dump($diceHand->sum());

        // $url = url("/session/destroy");

        // echo <<<EOD
        // <p><a href="$url">destroy the session</a></p>
        // EOD;

        $_SESSION["counter"] = 1 + ($_SESSION["counter"] ?? 0);
        $_SESSION["diceSumPlayer"] = $diceHand->sum();
        // $_SESSION["playerSum"] = $_SESSION["playerSum"] + $diceHand->sum() ?? 0;



        $body = renderView("layout/dice.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
