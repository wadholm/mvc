<?php

declare(strict_types=1);

namespace Mack\Dice;

/**
 * Graphical Dice.
 */
class GraphicalDice extends Dice
{
    private const FACES = 6;
    private $dicegraphics;
    private $graphic = [
        1 => "⚀",
        2 => "⚁",
        3 => "⚂",
        4 => "⚃",
        5 => "⚄",
        6 => "⚅",
    ];
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
    public function graphic(): string
    {
        return $this->graphic[$this->getLastRoll()];
    }

    public function graphicName(): string
    {

        return "dice-" . $this->getLastRoll();
    }

    public function diceGraphics(): string
    {
        return $this->dicegraphics[$this->getLastRoll()] = $this->graphic[$this->getLastRoll()];
    }

    public function asString(): string
    {
        return $this->graphic[$this->getLastRoll()];
    }
}
