<?php

declare(strict_types=1);

namespace Mack\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game PlayYatzy-class.
 */
class YatzyTestMessages extends TestCase
{

    // /**
    //  * Test to play game
    //  */
    // public function testPlayYatzy()
    // {
    //     $game = new PlayYatzy();
    //     $this->assertInstanceOf("\Mack\Game\PlayYatzy", $game);
    // }

    // /**
    //  * Test to start game
    //  */
    // public function testStartGameNoPost()
    // {
    //     $game = new PlayYatzy();
    //     $_POST = null;
    //     $res = $game->startGame();
    //     $exp = false;
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to start game
    //  */
    // public function testStartGame()
    // {
    //     $game = new PlayYatzy();
    //     $_POST["start"] = "start";

    //     $res = $game->startGame();
    //     $exp = true;
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to get the starting number of dices
    //  */
    // public function testGetFirstNumberOfDices()
    // {
    //     $game = new PlayYatzy();

    //     $res = $game->getFirstNumberOfDices();
    //     $exp = 5;
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to get number of dices
    //  */
    // public function testGetNumberOfDices()
    // {
    //     $game = new PlayYatzy();

    //     $_POST["dices"] = 4;
    //     $res = $game->getNumberOfDices();
    //     $exp = 4;
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to get checked boxes
    //  */
    // public function testGetCheckedBoxes()
    // {
    //     $game = new PlayYatzy();

    //     $_POST["dice-1"] = 1;
    //     $_POST["round"] = 1;
    //     $res = $game->getCheckedBoxes();
    //     $this->assertIsInt($res);
    // }

    // /**
    //  * Test to get session rounds
    //  */
    // public function testGetSessionRounds()
    // {
    //     $game = new PlayYatzy();

    //     $game->getSessionRounds();

    //     $this->assertIsInt($_SESSION["round-1"]);
    // }

    // /**
    //  * Test to reset session rounds
    //  */
    // public function testResetSessionRounds()
    // {
    //     $game = new PlayYatzy();

    //     $game->resetSessionRounds();
    //     $exp = 0;
    //     $this->assertEquals($exp, $_SESSION["round-1"]);
    // }

    // /**
    //  * Test to add score fail
    //  */
    // protected function testAddScoreFail()
    // {
    //     $game = new PlayYatzy();

    //     $res = $game->addScore(1);
    //     $exp = false;
    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to add score
    //  */
    // public function testAddScore()
    // {
    //     $game = new PlayYatzy();
    //     $_POST["dice-1"] = 1;
    //     $_POST["round"] = 1;

    //     $game->getCheckedBoxes();

    //     $game->addScore(1);

    //     $this->assertIsArray($_SESSION["score"]);
    // }

    /**
     * Test to get message roll 1 or 2
     */
    protected function testGetMessageRoll1()
    {
        $game = new PlayYatzy();

        $res = $game->getMessage(1, 1);
        $exp = "Select dices to save, then roll again.";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test to get message roll 3
     */
    protected function testGetMessageRoll3()
    {
        $game = new PlayYatzy();

        $res = $game->getMessage(1, 3);
        $exp = "Select dices to save.";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test to get message roll 4
     */
    protected function testGetMessageRoll4()
    {
        $game = new PlayYatzy();

        $res = $game->getMessage(1, 4);
        $exp = "You rolled 0 dices with the value of 1.";
        $this->assertEquals($exp, $res);
    }

    // /**
    //  * Test to play game
    //  */
    // public function testPlayGame()
    // {
    //     $game = new PlayYatzy();
    //     $rollDices = $_POST["rolldices"] = "rolldices";
    //     $res = $game->playGame($rollDices, 1, 1);

    //     $this->assertIsArray($res);
    // }

    // /**
    //  * Test to roll dices
    //  */
    // protected function testRollDices()
    // {
    //     $game = new PlayYatzy();
    //     $res = $game->rollDices(1, 1);

    //     $this->assertIsArray($res);
    // }

    // /**
    //  * Test to roll dices roll 3
    //  */
    // public function testDicesRoll3()
    // {
    //     $game = new PlayYatzy();

    //     $res = $game->rollDices(1, 3);

    //     $this->assertIsArray($res);
    // }


    // /**
    //  * Test to roll dices roll 4
    //  */
    // public function testDicesRoll4()
    // {
    //     $game = new PlayYatzy();

    //     $res = $game->rollDices(1, 4);

    //     $this->assertIsArray($res);
    // }

    // /**
    //  * Test to roll dices roll Yatzy
    //  */
    // public function testDicesRollYatzy()
    // {
    //     $game = new PlayYatzy();

    //     $game->getCheckedBoxes();
    //     $_SESSION["round-1"] = 4;
    //     $game->rollDices(1, 3);
    //     $exp = "You rolled Yatzy!!";

    //     $this->assertEquals($exp, $_SESSION["yatzy"]);
    // }


    // /**
    //  * Test to roll dices last round
    //  */
    // public function testDicesLastRound()
    // {
    //     $game = new PlayYatzy();
    //     $_SESSION["score"] = [1, 2, 3];

    //     $res = $game->rollDices(6, 4);

    //     $this->assertIsArray($res);
    // }

    // /**
    //  * Test to calculate total score
    //  */
    // public function testCalculateTotalScore()
    // {
    //     $game = new PlayYatzy();
    //     $score = [1, 2, 3];

    //     $res = $game->calculateTotalScore($score);
    //     $exp = 6;

    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to check for bonus false
    //  */
    // public function testCheckForBonusFalse()
    // {
    //     $game = new PlayYatzy();

    //     $game->getSessionRounds();

    //     $res = $game->checkForBonus();
    //     $exp = false;

    //     $this->assertEquals($exp, $res);
    // }

    // /**
    //  * Test to caheck for bonus true
    //  */
    // public function testCheckForBonusTrue()
    // {
    //     $game = new PlayYatzy();

    //     $game->getSessionRounds();

    //     $_SESSION["round-1"] = 3;
    //     $_SESSION["round-2"] = 3;
    //     $_SESSION["round-3"] = 3;
    //     $_SESSION["round-4"] = 3;
    //     $_SESSION["round-5"] = 3;
    //     $_SESSION["round-6"] = 3;

    //     $res = $game->calculateTotalScore([1, 62]);

    //     $res = $game->checkForBonus();
    //     $exp = true;

    //     $this->assertEquals($exp, $res);
    // }
}
