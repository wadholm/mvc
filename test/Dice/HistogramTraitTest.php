<?php

declare(strict_types=1);

namespace Mack\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Dice Dice-class.
 */
class HistogramTraitTest extends TestCase
{

    /**
     * Construct DiceHand and test to print histogram
     */
    public function testPrintHistogram()
    {
        // Arrange
        $die = new CheatDice();
        $die->roll(1);
        $die->roll(2);
        $die->roll(3);
        $die->roll(4);
        $die->roll(5);
        $die->roll(6);
        $res = $die->printHistogram();
        // $diceHand->addDice(new GraphicalDice());
        // $res = $diceHand->roll();

        // $res = $diceHand->getHand();
        $this->assertIsString($res);
    }
}
