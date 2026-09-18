<?php
// ============================================================================
// File:    IAuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Auth\IAuthService as IFrameworkAuthService;

use App\Support\DTOs\AuthDTO;


interface IAuthService extends IFrameworkAuthService
{
    public function auth(): ?AuthDTO;
}
