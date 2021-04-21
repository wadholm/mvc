<?php

declare(strict_types=1);

namespace Mack\Dice;

use PHPUnit\Framework\TestCase;
use Mack\Dice\Dice;

/**
 * Test cases for the Dice Dice-class.
 */
class DiceHandTest extends TestCase
{

    /**
     * Construct DiceHand and verify that the diceHand is expected instance,
     * use no arguments.
     */
    public function testCreateDiceHand()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Mack\Dice\DiceHand", $diceHand);
    }

    /**
     * Test the function roll
     */
    public function testRoll()
    {
        $diceHand = new DiceHand();
        $diceHand->addDice(new Dice());
        $res = $diceHand->roll();
        $this->assertTrue($res);
    }

    /**
     * Test the function getLastRoll
     */
    public function testGetLastRoll()
    {
        $diceHand = new DiceHand();
        $diceHand->addDice(new Dice());
        $res = $diceHand->roll();
        $res = $diceHand->getLastroll();
        $this->assertIsString($res);
    }

    //     /**
    //  * Test the function getLastRoll when it fails
    //  */
    // public function testGetLastRollFail()
    // {
    //     $diceHand = new DiceHand();
    //     $diceHand->addDice(new Dice());
    //     // $res = $diceHand->roll();
    //     $res = $diceHand->getLastroll();
    //     $this->expectException(DiceException::class);
    // }

    /**
     * Test the function sum
     */
    public function testSum()
    {
        $diceHand = new DiceHand();
        $diceHand->addDice(new Dice());
        $res = $diceHand->roll();
        $res = $diceHand->sum();
        $this->assertIsInt($res);
    }

    /**
     * Test the function getGraphics
     */
    public function testGetGraphics()
    {
        // Arrange
        $diceHand = new DiceHand();
        $diceHand->addDice(new GraphicalDice());
        $res = $diceHand->roll();

        $res = $diceHand->getGraphics();
        $this->assertIsArray($res);
    }

    /**
     * Test the function getGraphics2Rolls
     */
    public function testGetGraphics2Rolls()
    {
        // Arrange
        $diceHand = new DiceHand();
        $diceHand->addDice(new GraphicalDice());
        $res = $diceHand->roll();

        $res = $diceHand->getGraphics2Rolls();
        $this->assertIsArray($res);
    }

    /**
     * Test the function getRolls
     */
    public function testGetRolls()
    {
        // Arrange
        $diceHand = new DiceHand();
        $diceHand->addDice(new GraphicalDice());
        $res = $diceHand->roll();

        $res = $diceHand->getRolls();
        $this->assertIsArray($res);
    }

    /**
     * Test the function getHand
     */
    public function testGetHand()
    {
        // Arrange
        $diceHand = new DiceHand();
        $diceHand->addDice(new GraphicalDice());
        $res = $diceHand->roll();

        $res = $diceHand->getHand();
        $this->assertIsString($res);
    }
}
