<?php
// ============================================================================
// File:    ExampleMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Middlewares;


use Seymenkonuk\Framework\Middleware;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Response;


class ExampleMiddleware extends Middleware
{
    /** @param callable(Request): Response $next */
    public function handle(Request $request, callable $next): Response
    {
        return $next($request);
    }
}
