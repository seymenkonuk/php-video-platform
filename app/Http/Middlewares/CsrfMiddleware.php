<?php
// ============================================================================
// File:    CsrfMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Middlewares;


use Seymenkonuk\Framework\CsrfToken;
use Seymenkonuk\Framework\Middleware;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Response;

use App\Support\Factories\ErrorViewModelFactory;


class CsrfMiddleware extends Middleware
{
    public function __construct(
        protected Response $response,
        protected CsrfToken $csrfToken,
    ) {}

    /** @param callable(Request): Response $next */
    public function handle(ErrorViewModelFactory $errorViewModelFactory, Request $request, callable $next): Response
    {
        // GET isteklerinde csrf token oluştur
        if ($request->method() === "GET") {
            if ($this->csrfToken->hasExpired()) {
                $this->csrfToken->refresh();
            }
        }

        // GET harici isteklerde csrf token'ı doğrula
        if ($request->method() !== "GET") {
            /** @var ?string $token */
            $token = $request->post("csrfToken", null);
            if (!$this->csrfToken->isValid($token)) {
                return $this->response->abort(403, [
                    "model" => $errorViewModelFactory->badRequest("Erişim Reddedildi", "Geçersiz veya süresi dolmuş CSRF token!"),
                ]);
            }
        }

        // Token Doğrulama Başarılıysa Controller'ı Çağır
        return $next($request);
    }
}
