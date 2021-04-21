<?php

declare(strict_types=1);

namespace Mack\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Dice Dice-class.
 */
class GraphicalDiceTest extends TestCase
{

    /**
     * Construct dice and verify that the dice has the expected
     * properties, use no arguments.
     */
    public function testCreateGraphicalDiceNoArguments()
    {
        $die = new GraphicalDice();
        $this->assertInstanceOf("\Mack\Dice\GraphicalDice", $die);

        $res = $die->faces();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test the function graphic
     */
    public function testGraphic()
    {
        // Arrange
        $die = new GraphicalDice();

        $die->roll();
        $res = $die->graphic();
        $this->assertIsString($res);
    }

    /**
     * Test the function graphicName
     */
    public function testGraphicName()
    {
        // Arrange
        $die = new GraphicalDice();

        $die->roll();
        $res = $die->graphicName();
        $this->assertStringStartsWith("dice-", $res);
    }

    /**
     * Test the function diceGraphics
     */
    public function testDiceGraphics()
    {
        // Arrange
        $die = new GraphicalDice();

        $die->roll();
        $res = $die->diceGraphics();
        $this->assertIsString($res);
    }

    /**
     * Test the function asString
     */
    public function testAsString()
    {
        // Arrange
        $die = new GraphicalDice();

        $die->roll();
        $res = $die->asString();
        $this->assertIsString($res);
    }
}
