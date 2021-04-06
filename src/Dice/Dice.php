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
class Dice
{

    protected $faces;

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }
    // const FACES = 6;

    private $roll = null;

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
