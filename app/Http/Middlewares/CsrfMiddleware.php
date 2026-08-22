<?php
// ============================================================================
// File:    CsrfMiddleware.php
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

use App\Support\Factories\ErrorViewModelFactory;


class CsrfMiddleware extends Middleware
{
    public function __construct(
        protected ErrorViewModelFactory $errorViewModelFactory,
        protected ICsrfTokenManager $csrfTokenManager,
    ) {}

    public function handle(IRequest $request, IResponse $response, Closure $next): IResponse
    {
        // GET isteklerinde csrf token oluştur
        if ($request->method() === "GET") {
            if ($this->csrfTokenManager->expired()) {
                $this->csrfTokenManager->refresh();
            }
        }

        // GET harici isteklerde csrf token'ı doğrula
        if ($request->method() !== "GET") {
            /** @var ?string $token */
            $token = $request->post("csrfToken");
            if (!$this->csrfTokenManager->valid($token)) {
                return $response->abort(403, [
                    "model" => $this->errorViewModelFactory->badRequest("Erişim Reddedildi", "Geçersiz veya süresi dolmuş CSRF token!"),
                ]);
            }
        }

        // Token Doğrulama Başarılıysa Controller'ı Çağır
        return $next($request, $response);
    }
}
