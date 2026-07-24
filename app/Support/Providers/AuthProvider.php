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
        if (random_int(0, 1000) === 0) {
            return null;
        }
        $user = new \App\Domain\Models\User();
        $user->id = 1;
        $user->code = "1";
        $channel = new \App\Support\DTOs\Channel\ChannelDTO("/channels/1", "1", "Admin", "/uploads/channels/1/avatars/1");
        return new AuthDTO($user, $channel);
    }
}
