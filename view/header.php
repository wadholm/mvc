<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

?><!doctype html>
<html>
    <meta charset="utf-8">
    <title><?= $title ?? "No title" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= url("/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" href="<?= url("/../css/style.css") ?>">
</head>

<body>

<header>
    <nav>
        <a class="active" href="<?= url("/") ?>">Home</a> |
        <a href="<?= url("/session") ?>">Session</a> |
        <a href="<?= url("/debug") ?>">Debug</a> |
        <a href="<?= url("/game21/home") ?>">Game21</a> |
        <a href="<?= url("/yatzy/home") ?>">Yatzy</a> |
        <a href="<?= url("/no/such/path") ?>">Show 404 example</a>
    </nav>
</header>
<main>
