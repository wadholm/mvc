<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});


$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");
$router->addRoute("GET", "/dice", "\Mos\Controller\Game");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/game21", function (RouteCollector $router) {
    $router->addRoute("GET", "/home", ["\Mos\Controller\Game21", "home"]);
    $router->addRoute("GET", "/home/destroy", ["\Mos\Controller\Game21", "destroy"]);
    $router->addRoute("POST", "/play", ["\Mos\Controller\Game21", "play"]);
    $router->addRoute("GET", "/result", ["\Mos\Controller\Game21", "result"]);
});

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "/home", ["\Mos\Controller\GameYatzy", "home"]);
    $router->addRoute("GET", "/home/destroy", ["\Mos\Controller\GameYatzy", "destroy"]);
    $router->addRoute("POST", "/play", ["\Mos\Controller\GameYatzy", "play"]);
    $router->addRoute("GET", "/result", ["\Mos\Controller\GameYatzy", "result"]);
});
