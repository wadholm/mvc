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
class DiceHand implements HistogramInterface
{
    use HistogramTrait;

    private $dices;
    private $graphicalDices;
    private $rolls;
    private $graphics2rolls;
    private $sum;
    private $numberDices = null;

    // public function __construct(int $numberDices = 2)
    // {
    //     for ($i = 0; $i < $numberDices; $i++) {
    //         $this->dices[$i] = new GraphicalDice();
    //     }
    // }

    public function addDice(DiceInterface $dice)
    {
        $this->numberDices++;
        $this->dices[] = $dice;
    }

    // public function removeDice()
    // {
    //     array_pop($this->dices);
    // }

    public function roll(): bool
    {
        $len = count($this->dices);

        $this->sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->dices[$i]->roll();
            $this->addToHistogram(
                $this->dices[$i]->getLastRoll()
            );
        }
        return true;
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

    public function getGraphics2Rolls(): array
    {
        $len = count($this->dices);

        for ($i = 0; $i < $len; $i++) {
            $this->graphics2rolls[$i + 1] = array("graphic" => $this->dices[$i]->graphic(), "value" => $this->dices[$i]->getLastRoll());
            // var_dump($data["graphicalDice"]);
        }
        return $this->graphics2rolls;
    }

    public function getRolls(): array
    {
        $len = count($this->dices);

        for ($i = 0; $i < $len; $i++) {
            $this->rolls[] = $this->dices[$i]->getLastRoll();
        }
        return $this->rolls;
    }

    public function getHand(): string
    {
        $len = count($this->dices);
        $average = $this->sum / $len;
        $res = "";
        for ($i = 0; $i < $len; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . " ";
        }
        return <<<EOT
        Your hand rolled $len dices:
        $res
        Sum = $this->sum
        Average = $average
        EOT;
    }
}
