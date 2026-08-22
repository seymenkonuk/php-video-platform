<?php
// ============================================================================
// File:    AuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services;


use Seymenkonuk\Framework\Auth\IAuthService;


class AuthService implements IAuthService
{
    public function authenticated(): bool
    {
        return false;
    }
}
