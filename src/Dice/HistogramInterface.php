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

interface HistogramInterface
{
    public function printHistogram(): string;
}
