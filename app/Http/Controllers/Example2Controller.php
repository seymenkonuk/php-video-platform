<?php
// ============================================================================
// File:    Example2Controller.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use App\Http\Schemas\ExampleSchema;
use App\Http\Middlewares\ExampleMiddleware;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Session;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/example2")]
#[Middleware(ExampleMiddleware::class)]
class Example2Controller extends Controller
{
    public function __construct(protected Response $response) {}

    #[Get("")]
    public function index(Session $session): Response
    {
        $session->flash("deneme", "tekrar hoşgeldin!");
        return $this->response->html("<p>Example 2</p>");
    }

    #[Get("/show")]
    #[Schema(ExampleSchema::class)]
    public function show(Session $session): Response
    {
        /** @var string $value */
        $value = $session->getFlash("deneme", "hoşgeldin!");
        return $this->response->html("<p>{$value}</p>");
    }
}
