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
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private array $graphicalDices;
    private int $sum;
    protected int $number;

    public function __construct(int $number = 2)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->dices[$i] = new GraphicalDice();
        }
    }

    public function roll(): void
    {
        $len = count($this->dices);

        $this->sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): string
    {
        $len = count($this->dices);

        $res = "";
        for ($i = 0; $i < $len; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . ", ";
        }
        return $res . " = " . $this->sum;
    }

    public function sum(): int
    {
        return $this->sum;
    }

    public function getGraphics(): array
    {
        $len = count($this->dices);

        for ($i = 0; $i < $len; $i++) {
            $this->graphicalDices[] = $this->dices[$i]->graphic();
            // var_dump($data["graphicalDice"]);
        }
        return $this->graphicalDices;
    }
}
