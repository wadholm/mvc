<?php

declare(strict_types=1);

namespace Mack\Dice;

/**
 * Cheat Dice.
 */
class CheatDice extends Dice
{
    private const FACES = 6;

    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct()
    {
        parent::__construct(self::FACES);
    }

    public function roll($cheat = 6): int
    {
        $this->roll = $cheat;
        $this->addToHistogram($this->roll);

        return $this->roll;
    }
}
