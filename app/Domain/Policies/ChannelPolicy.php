<?php
// ============================================================================
// File:    ChannelPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


class ChannelPolicy
{
    public static function canView(/*?User $auth, Channel $channel*/): bool
    {
        // Herkes Tüm Kanalları Görüntüleyebilir
        return true;
    }

    public static function canList(/*?User $auth, Channel $channel*/): bool
    {
        // Herkes Tüm Kanalları Listeleyebilir
        return true;
    }

    public static function canCreate(/*?User $auth*/): bool
    {
        // Giriş Yapan Herkes Kanal Oluşturabilir
        return true;
    }

    public static function canEdit(/*?User $auth, Channel $channel*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Kanalı Düzenleyebilir
        return true;
    }

    public static function canDelete(/*?User $auth, Channel $channel*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Kanalı Silebilir
        return true;
    }
}
