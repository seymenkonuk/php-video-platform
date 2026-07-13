<?php
// ============================================================================
// File:    ChannelPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Models\Channel;
use App\Domain\Models\User;

use App\Support\DTOs\AuthDTO;


class ChannelPolicy
{
    public static function canView(?AuthDTO $auth, Channel $channel): bool
    {
        // Herkes Tüm Kanalları Görüntüleyebilir
        return true;
    }

    public static function canList(?AuthDTO $auth, Channel $channel): bool
    {
        // Herkes Tüm Kanalları Listeleyebilir
        return true;
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapan Herkes Kanal Oluşturabilir
        return $auth !== null;
    }

    public static function canEdit(?AuthDTO $auth, Channel $channel): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if ($auth === null) {
            return false;
        }
        // Sadece Sahibi Olan Kullanıcı Kanalı Düzenleyebilir
        return $auth->channel->code === $channel->code;
    }

    public static function canDelete(?AuthDTO $auth, Channel $channel): bool
    {
        // Sadece Sahibi Olan Kullanıcı Kanalı Silebilir
        return self::canEdit($auth, $channel);
    }
}
