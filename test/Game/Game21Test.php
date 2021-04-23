<?php

declare(strict_types=1);

namespace Mack\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game PlayGame21-class.
 */
class Game21Test extends TestCase
{

    /**
     * Test to play game
     */
    public function testPlayGame21()
    {
        $game = new PlayGame21();
        $this->assertInstanceOf("\Mack\Game\PlayGame21", $game);
    }

    /**
     * Test to start game with POST
     */
    public function testStartGame()
    {
        $game = new PlayGame21();
        $_POST["start"] = "start";

        $game->startGame();
        $exp = 0;
        $this->assertEquals($exp, $_SESSION["playerSum"]);
    }

    /**
     * Test to get dices
     */
    public function testGetNumberOfDices()
    {
        $game = new PlayGame21();

        $_POST["dices"] = 2;
        $res = $game->getNumberOfDices();
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test to play a round of 21
     */
    public function testPlayGameRoll()
    {
        $game = new PlayGame21();
        $roll = $_POST["roll"] = "roll";
        $_SESSION["playerSum"] = 0;
        $_SESSION["dataSum"] = 0;
        $_SESSION["playerWins"] = 0;
        $_SESSION["dataWins"] = 0;


        $res = $game->playGame($roll);
        $this->assertIsArray($res);
    }

    /**
     * Test to play a round of 21
     */
    public function testPlayGameStop()
    {
        $game = new PlayGame21();
        $roll = $_POST["roll"] = "stop";
        $_SESSION["playerSum"] = 0;
        $_SESSION["dataSum"] = 0;
        $_SESSION["playerWins"] = 0;
        $_SESSION["dataWins"] = 0;


        $res = $game->playGame($roll);
        $this->assertIsArray($res);
    }

    /**
     * Test to roll Player
     */
    public function testRollPlayer()
    {
        $game = new PlayGame21();
        $_SESSION["playerSum"] = 0;
        $_SESSION["playerWins"] = 0;
        $_SESSION["playerWinner"] = true;

        $res = $game->rollPlayer($_SESSION["playerSum"]);
        $this->assertIsArray($res);
    }

        /**
     * Test to roll Player above 21
     */
    public function testRollPlayerAbove21()
    {
        $game = new PlayGame21();
        $_SESSION["playerSum"] = 21;
        $_SESSION["playerWins"] = 0;
        $_SESSION["playerWinner"] = true;

        $res = $game->rollPlayer($_SESSION["playerSum"]);
        $this->assertIsArray($res);
    }

    /**
     * Test to roll Player get 21
     */
    public function testRollPlayer21()
    {
        $game = new PlayGame21();
        $_SESSION["playerSum"] = 21;
        $_SESSION["playerWins"] = 0;
        $_SESSION["playerWinner"] = true;

        $res = $game->rollPlayer($_SESSION["playerSum"], 21);
        $this->assertIsArray($res);
    }

    /**
     * Test to roll Computer
     */
    public function testRollComputerWins()
    {
        $game = new PlayGame21();
        $_SESSION["playerSum"] = 21;
        $_SESSION["dataSum"] = 0;
        $_SESSION["dataWins"] = 0;
        $_SESSION["dataWinner"] = true;

        $res = $game->rollComputer($_SESSION["playerSum"]);
        $this->assertIsArray($res);
    }

        /**
     * Test to roll Computer
     */
    public function testRollComputerPlayerWins()
    {
        $game = new PlayGame21();
        $_SESSION["playerSum"] = 21;
        $_SESSION["dataSum"] = 22;
        $_SESSION["dataWins"] = 0;
        $_SESSION["dataWinner"] = false;

        $res = $game->rollComputer($_SESSION["playerSum"]);
        $this->assertIsArray($res);
    }
}
