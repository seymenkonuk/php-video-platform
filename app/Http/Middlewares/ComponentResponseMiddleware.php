<?php
// ============================================================================
// File:    ComponentResponseMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Middlewares;


use Closure;

use Seymenkonuk\Framework\CsrfToken\ICsrfTokenManager;
use Seymenkonuk\Framework\Http\Middleware;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;


class ComponentResponseMiddleware extends Middleware
{
    public function __construct(
        protected ICsrfTokenManager $csrfTokenManager,
    ) {}

    public function handle(IRequest $request, IResponse $response, Closure $next): IResponse
    {
        $component = $next($request, $response);

        return $response->json([
            "html" => $component->state()->body(),
            "csrfToken" => $this->csrfTokenManager->refresh(),
        ]);
    }
}
