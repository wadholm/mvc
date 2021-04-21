<?php

declare(strict_types=1);

namespace Mack\Dice;

use TypeError;

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
    use HistogramTrait;

    private $faces;
    protected $roll = null;
    // private ?int $lastRoll = null;

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    /**
     * Get faces of the die.
     *
     * @return int as number of faces.
     */
    public function faces()
    {
        return $this->faces;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        $this->addToHistogram($this->roll);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        // if ($this->roll == null) {
        //     throw new DiceException("No dices rolled.");
        // }
        return $this->roll;
    }

    public function asString(): string
    {

        return (string) $this->roll;
    }
}
