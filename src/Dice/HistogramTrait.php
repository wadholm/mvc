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
 * Trait HistogramTrait.
 */
trait HistogramTrait
{
    protected $histogramValues = [];
    // protected array $histogramValues = [];

    protected function addToHistogram(int $value): void
    {
        $this->histogramValues[] = $value;
    }

    public function printHistogram(): string
    {
        $stars1 = "";
        $stars2 = "";
        $stars3 = "";
        $stars4 = "";
        $stars5 = "";
        $stars6 = "";

        foreach ($this->histogramValues as $value) {
            switch ($value) {
                case 1:
                    $stars1 = $stars1 . "*";
                    break;
                case 2:
                    $stars2 = $stars2 . "*";
                    break;
                case 3:
                    $stars3 = $stars3 . "*";
                    break;
                case 4:
                    $stars4 = $stars4 . "*";
                    break;
                case 5:
                    $stars5 = $stars5 . "*";
                    break;
                case 6:
                    $stars6 = $stars6 . "*";
                    break;
            }
        }
        // Print the histogram from the
        // $this->histogramValues[]
        return <<<EOT
        1: $stars1
        2: $stars2
        3: $stars3
        4: $stars4
        5: $stars5
        6: $stars6
        EOT;
    }
}
