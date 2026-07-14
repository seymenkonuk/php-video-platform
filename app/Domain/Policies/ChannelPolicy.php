<?php
// ============================================================================
// File:    ChannelPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Models\Channel;

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
        // Sadece Sahibi Olan Kullanıcı Kanalı Düzenleyebilir
        return self::isMyChannel($auth, $channel);
    }

    public static function canDelete(?AuthDTO $auth, Channel $channel): bool
    {
        // Sadece Sahibi Olan Kullanıcı Kanalı Silebilir
        // Aktif Kanal Silinemez
        return self::isMyChannel($auth, $channel) && !self::isActiveChannel($auth, $channel);
    }

    // --------------------------------------------------------------------------
    // HELPERS
    // --------------------------------------------------------------------------

    private static function isMyChannel(?AuthDTO $auth, Channel $channel): bool
    {
        return $auth !== null && $auth->user->id === $channel->user_id;
    }

    private static function isActiveChannel(?AuthDTO $auth, Channel $channel): bool
    {
        return $auth !== null && $auth->user->active_channel_id === $channel->id;
    }
}
