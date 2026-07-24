<?php
// ============================================================================
// File:    AuthProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use App\Support\DTOs\AuthDTO;


final readonly class AuthProvider
{
    public function auth(): ?AuthDTO
    {
        return null;
    }
}
