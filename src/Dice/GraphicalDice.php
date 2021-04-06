<?php

declare(strict_types=1);

namespace Mack\Dice;

/**
 * Graphical Dice.
 */
class GraphicalDice extends Dice
{
    /**
     * @var integer SIDES Number of sides of the Dice.
     */
    const FACES = 6;

    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct()
    {
        parent::__construct(self::FACES);
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
