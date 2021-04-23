<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Game21.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Mos\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response for home-page.
     */
    public function testControllerReturnsResponseHome()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->home();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        session_start();
        $controller = new Game21();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }

    /**
     * Check that the controller returns a response for play-page.
     */
    public function testControllerReturnsResponsePlay()
    {
        $controller = new Game21();
        $_POST["dices"] = 5;
        $_SESSION["playerSum"] = 0;

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response for play-page.
     */
    public function testControllerReturnsResponsePlay2Result()
    {
        $controller = new Game21();
        $_POST["dices"] = 5;
        $_SESSION["playerSum"] = 0;
        $_SESSION["playerWinner"] = true;
        $_SESSION["result"] = "";

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response for result-page.
     */
    public function testControllerReturnsResponseResult()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->result();
        $this->assertInstanceOf($exp, $res);
    }
}
