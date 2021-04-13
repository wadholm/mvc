<?php

declare(strict_types=1);

namespace Mack\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };


/**
 * Class Dice.
 */
class Dice implements DiceInterface
{

    // use HistogramTrait;

    private $faces;
    private $roll = null;
    // private ?int $lastRoll = null;

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        // $this->addToHistogram($this->roll);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }

    public function asString(): string
    {
        return (string) $this->roll;
    }
}
