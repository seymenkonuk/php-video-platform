<?php
// ============================================================================
// File:    Example1Controller.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Response;


class Example1Controller extends Controller
{
    public function index(Request $request, Response $response): Response
    {
        /** @var string $deneme */
        $deneme = $request->query("deneme", "deneme");
        return $response->html("<p>deneme{$deneme}</p>");
    }
}
