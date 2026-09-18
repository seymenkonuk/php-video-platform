<?php
// ============================================================================
// File:    AuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Services\Abstract\IAuthService;
use App\Support\DTOs\AuthDTO;


class AuthService implements IAuthService
{
    public function authenticated(): bool
    {
        // şimdilik örnek bir veri dönüyor...
        // ileride session ve vt kullanılarak gerçek değer döndürülecek
        return true;
    }

    public function auth(): ?AuthDTO
    {
        // şimdilik örnek bir veri dönüyor...
        // ileride session ve vt kullanılarak gerçek değer döndürülecek
        $user = new \App\Domain\Models\User();
        $user->id = 1;
        $user->code = "1";
        $channel = new \App\Support\DTOs\Channel\ChannelDTO("/channels/1", "1", "Admin", "/uploads/channels/1/avatars/1");
        return new AuthDTO($user, $channel);
    }
}
