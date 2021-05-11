<?php

declare(strict_types=1);

namespace Mack\Game;

use PHPUnit\Framework\TestCase;

// /**
//  * Test cases for the Game PlayYatzy-class.
//  */
// class YatzyTestRolls extends TestCase
// {
// /**
//      * Test to roll dices
//      */
//     public function testRollDices()
//     {
//         $game = new PlayYatzy();
//         $res = $game->rollDices(1, 1);

//         $this->assertIsArray($res);
//     }

//     /**
//      * Test to roll dices roll 3
//      */
//     public function testDicesRoll3()
//     {
//         $game = new PlayYatzy();

//         $res = $game->rollDices(1, 3);

//         $this->assertIsArray($res);
//     }

//     // /**
//     //  * Test to roll dices roll 4
//     //  */
//     // public function testDicesRoll4()
//     // {
//     //     $game = new PlayYatzy();

//     //     $res = $game->rollDices(1, 4);

//     //     $this->assertIsArray($res);
//     // }

//     // /**
//     //  * Test to roll dices roll Yatzy
//     //  */
//     // public function testDicesRollYatzy()
//     // {
//     //     $game = new PlayYatzy();

//     //     $game->getCheckedBoxes();
//     //     $_SESSION["round-1"] = 4;
//     //     $game->rollDices(1, 3);
//     //     $exp = "You rolled Yatzy!!";

//     //     $this->assertEquals($exp, $_SESSION["yatzy"]);
//     // }


//     /**
//      * Test to roll dices last round
//      */
//     public function testDicesLastRound()
//     {
//         $game = new PlayYatzy();
//         $_SESSION["score"] = [1, 2, 3];

//         $res = $game->rollDices(6, 4);

//         $this->assertIsArray($res);
//     }
// }
