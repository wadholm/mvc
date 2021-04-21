<?php

// declare(strict_types=1);

// namespace Mack\Dice;

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;

// // use Mack\Dice\GraphicalDice;

// use function Mos\Functions\{
//     renderView,
//     url
// };

// /**
//  * Class Game.
//  */
// class Game
// {
//     public function playGame(): void
//     {
//         $data = [
//             "header" => "Dice",
//             "message" => "Hey, this is your dice-game!",
//         ];

//         $die = new Dice();
//         $diceHand = new DiceHand();
//         // $graphicalDie = new GraphicalDice();
//         // $rolls = 2;

//         $die->roll();
//         $diceHand->roll();


//         $data["dieLastRoll"] = $die->getLastRoll();
//         $data["diceHandRoll"] = $diceHand->getLastRoll();

//         $_SESSION["diceSumData"] = $diceHand->sum();
//         $_SESSION["dataSum"] += $diceHand->sum();
//         // $data["graphicalDice"] = [];

//         // for ($i = 0; $i < $rolls; $i++) {
//         //     $graphicalDie->roll();
//         //     $data["graphicalDice"][$i] = $graphicalDie->graphic();
//         //     // var_dump($data["graphicalDice"]);
//         // }

//         $diceHand->roll();
//         $data["diceHandRoll2"] = $diceHand->getLastRoll();
//         $data["graphicalDice"] = $diceHand->getGraphics();
//         // var_dump($diceHand->sum());

//         // $url = url("/session/destroy");

//         // echo <<<EOD
//         // <p><a href="$url">destroy the session</a></p>
//         // EOD;

//         $_SESSION["counter"] = 1 + ($_SESSION["counter"] ?? 0);
//         $_SESSION["diceSumPlayer"] = $diceHand->sum();
//         $_SESSION["playerSum"] += $diceHand->sum();

//         $body = renderView("layout/dice.php", $data);
//         // sendResponse($body);
//     }
// }
