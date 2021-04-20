<?php

declare(strict_types=1);

namespace Mos\Functions;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Mack\Dice\GraphicalDice;
use Mack\Dice\DiceHand;

/**
 * Functions.
 */


/**
 * Get the route path representing the page being requested.
 *
 * @return string with the route path requested.
 */
function getRoutePath(): string
{
    $offset = strlen(dirname($_SERVER["SCRIPT_NAME"] ?? null));
    $path   = substr($_SERVER["REQUEST_URI"] ?? "", $offset);

    return $path ? $path : "";
}



/**
 * Render the view and return its rendered content.
 *
 * @param string $template to use when rendering the view.
 * @param array  $data     send to as variables to the view.
 *
 * @return string with the route path requested.
 */
function renderView(
    string $template,
    array $data = []
): string {
    extract($data);

    ob_start();
    require INSTALL_PATH . "/view/$template";
    $content = ob_get_contents();
    ob_end_clean();

    return ($content ? $content : "");
}



/**
 * Use Twig to render a view and return its rendered content.
 *
 * @param string $template to use when rendering the view.
 * @param array  $data     send to as variables to the view.
 *
 * @return string with the route path requested.
 */
function renderTwigView(
    string $template,
    array $data = []
): string {
    static $loader = null;
    static $twig = null;

    if (is_null($twig)) {
        $loader = new FilesystemLoader(
            INSTALL_PATH . "/view/twig"
        );
        // $twig = new \Twig\Environment($loader, [
        //     "cache" => INSTALL_PATH . "/cache/twig",
        // ]);
        $twig = new Environment($loader);
    }

    return $twig->render($template, $data);
}



// /**
//  * Send a response to the client.
//  *
//  * @param int    $status   HTTP status code to send to client.
//  *
//  * @return void
//  */
// function sendResponse(string $body, int $status = 200): void
// {
//     http_response_code($status);
//     echo $body;
// }
//
//
//
// /**
//  * Redirect to an url.
//  *
//  * @param string $url where to redirect.
//  *
//  * @return void
//  */
// function redirectTo(string $url): void
// {
//     http_response_code(200);
//     header("Location: $url");
// }



/**
 * Create an url into the website using the path and prepend the baseurl
 * to the current website.
 *
 * @param string $path to use to create the url.
 *
 * @return string with the route path requested.
 */
function url(string $path): string
{
    return getBaseUrl() . $path;
}



/**
 * Get the base url from the request, relative to the htdoc/ directory.
 *
 * @return string as the base url.
 */
function getBaseUrl()
{
    static $baseUrl = null;

    if ($baseUrl) {
        return $baseUrl;
    }

    $scriptName = rawurldecode($_SERVER["SCRIPT_NAME"] ?? null);
    $path = rtrim(dirname($scriptName), "/");

    // Prepare to create baseUrl by using currentUrl
    $parts = parse_url(getCurrentUrl());

    // Build the base url from its parts
    $siteUrl = ($parts["scheme"] ?? null)
        . "://"
        . ($parts["host"] ?? null)
        . (isset($parts["port"])
            ? ":{$parts["port"]}"
            : "");
    $baseUrl = $siteUrl . $path;

    return $baseUrl;
}



/**
 * Get the current url of the request.
 *
 * @return string as current url.
 */
function getCurrentUrl(): string
{
    $scheme = $_SERVER["REQUEST_SCHEME"] ?? "";
    $server = $_SERVER["SERVER_NAME"] ?? "";

    $port  = $_SERVER["SERVER_PORT"] ?? "";
    $port  = ($port === "80")
        ? ""
        : (($port === 443 && ($_SERVER["HTTPS"] ?? null) === "on")
            ? ""
            : ":" . $port);

    $uri = rtrim(rawurldecode($_SERVER["REQUEST_URI"] ?? ""), "/");

    $url  = htmlspecialchars($scheme) . "://";
    $url .= htmlspecialchars($server)
        . $port . htmlspecialchars(rawurldecode($uri));

    return $url;
}



/**
 * Destroy the session.
 *
 * @return void
 */
function destroySession(): void
{
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}


// /**
//  * Start new game.
//  *
//  * @return void
//  */
// function newGame(): void
// {
//     $newGame = $_POST["start"] ?? null;
//     if ($newGame == "start") {
//         $_SESSION["playerSum"] = 0;
//         $_SESSION["dataSum"] = 0;
//     }
// }

/**
 * Roll dices.
 *
 * @return object
 */
function addDices($diceHand, $numberDices): object
{
    for ($i = 0; $i < $numberDices; $i++) {
        $diceHand->addDice(new GraphicalDice());
    }
    return $diceHand;
}

/**
 * Print histogram.
 *
 * @return string
 */
function printHistogram($score): string
{
    $stars1 = "";
    $stars2 = "";
    $stars3 = "";
    $stars4 = "";
    $stars5 = "";
    $stars6 = "";

    foreach ($score as $value) {
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
    1: $stars1 <br>
    2: $stars2 <br>
    3: $stars3 <br>
    4: $stars4 <br>
    5: $stars5 <br>
    6: $stars6 <br>
    EOT;
}
