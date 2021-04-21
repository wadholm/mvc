<?php

declare(strict_types=1);

namespace Mack\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Dice Dice-class.
 */
class DiceTest extends TestCase
{

    /**
     * Construct dice and verify that the dice has the expected
     * properties, use no arguments.
     */
    public function testCreateDiceNoArguments()
    {
        $die = new Dice();
        $this->assertInstanceOf("\Mack\Dice\Dice", $die);

        $res = $die->faces();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct dice and verify that the dice has the expected
     * properties, use arguments.
     */
    public function testCreateDiceWithArguments()
    {
        $die = new Dice(4);
        $this->assertInstanceOf("\Mack\Dice\Dice", $die);

        $res = $die->faces();
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test the function roll().
     */
    public function testRoll()
    {
        $die = new Dice();
        $res = $die->roll();
        $this->assertIsInt($res);
    }

    /**
     * Test the function getLastRoll().
     */
    public function testGetLastRoll()
    {
        $die = new Dice();
        $die->roll();
        $res = $die->getLastRoll();
        $this->assertIsInt($res);
    }

    /**
     * Test the function asString().
     */
    public function testAsString()
    {
        $die = new Dice();
        $die->roll();
        $res = $die->asString();
        $this->assertIsString($res);
    }

    /**
     * Test the function asString() when no dice have been rolled.
     */
    public function testAsStringFail()
    {
        $die = new Dice();
        // $die->roll();
        $res = $die->asString();
        $exp = "";
        $this->assertEquals($exp, $res);
    }
}
