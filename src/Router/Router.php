<?php

declare(strict_types=1);

namespace Mos\Router;

use Mack\Dice\Game;
use Mack\Dice\Game21;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $callable = new Game();
            $callable->playGame();

            return;
        } else if ($method === "GET" && $path === "/home21") {
            $data = [
                "header" => "Game21",
                "message" => "Hey, this is your dice-game!",
            ];
            $body = renderView("layout/home21.php", $data);
            sendResponse($body);


            // $callable = new \Mack\Dice\Game21();
            // $callable->playGame();

            return;
        } else if ($method === "POST" && $path === "/game21") {
            $newGame = $_POST["start"] ?? null;
            if ($newGame == "start") {
                $_SESSION["playerSum"] = 0;
                $_SESSION["dataSum"] = 0;
            }
            $callable = new Game21();
            $callable->playGame();

            return;
        } else if ($method === "GET" && $path === "/result21") {
            $data = [
                "header" => "Game21",
                "message" => "Hey, this is your dice-game!",
            ];
            $body = renderView("layout/result21.php", $data);
            sendResponse($body);


            // $callable = new \Mack\Dice\Game21();
            // $callable->playGame();

            return;
        } else if ($method === "GET" && $path === "/home21/destroy") {
            destroySession();
            redirectTo(url("/home21"));
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
