<?php
// ============================================================================
// File:    ComponentResponseMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Middlewares;


use Seymenkonuk\Framework\Middleware;
use Seymenkonuk\Framework\CsrfToken;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Response;


class ComponentResponseMiddleware extends Middleware
{
    public function __construct(
        protected Response $response,
        protected CsrfToken $csrfToken,
    ) {}

    /** @param callable(Request): Response $next */
    public function handle(Request $request, callable $next): Response
    {
        $component = $next($request);

        return $this->response->json([
            "html" => $component->getBody(),
            "csrfToken" => $this->csrfToken->refresh(),
        ]);
    }
}
