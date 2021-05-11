<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Factory\Psr17Factory;

use function Mos\Functions\renderView;

/**
 * Controller for the debug route.
 * @return Psr\Http\Message\ResponseInterface
 */
class Debug
{
    public function __invoke()
    {
        $body = renderView("layout/debug.php");
        $psr17Factory = new Psr17Factory();

        return (new Response())
            ->withStatus(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
