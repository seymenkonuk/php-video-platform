<?php
// ============================================================================
// File:    AuthProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use App\Domain\Services\Abstract\IAuthService;
use App\Support\DTOs\AuthDTO;


final readonly class AuthProvider
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        public IAuthService $authService,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function auth(): ?AuthDTO
    {
        return $this->authService->auth();
    }
}
