<?php
// ============================================================================
// File:    AuthDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


use App\Domain\Models\User;


readonly class AuthDTO
{
    public function __construct(
        public User         $user,
        public ChannelDTO   $channel,
    ) {}
}
