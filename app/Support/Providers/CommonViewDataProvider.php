<?php
// ============================================================================
// File:    CommonViewDataProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use Seymenkonuk\Framework\CsrfToken;


final readonly class CommonViewDataProvider
{
    public function __construct(
        public CsrfToken $csrfToken,
    ) {}

    public function brandName(): string
    {
        return getenv("APP_NAME") ?: "Video Platform";
    }

    public function csrfToken(): string
    {
        return $this->csrfToken->getToken() ?? "";
    }

    public function dateYear(): string
    {
        return date("Y");
    }
}
