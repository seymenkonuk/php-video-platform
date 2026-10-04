<?php
// ============================================================================
// File:    CommonViewDataProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use Seymenkonuk\Framework\CsrfToken\ICsrfTokenManager;


final readonly class CommonViewDataProvider
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        public ICsrfTokenManager $csrfTokenManager,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function brandName(): string
    {
        return getenv("APP_NAME") ?: "Video Platform";
    }

    public function csrfToken(): string
    {
        return $this->csrfTokenManager->get() ?: "";
    }

    public function dateYear(): string
    {
        return date("Y");
    }
}
