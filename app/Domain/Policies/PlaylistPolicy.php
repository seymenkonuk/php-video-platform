<?php
// ============================================================================
// File:    PlaylistPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Enums\ViewType;

use App\Domain\Models\Playlist;

use App\Support\DTOs\AuthDTO;


class PlaylistPolicy
{
    public static function canView(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Gizli Olmayan Oynatma Listelerini Herkes Görüntüleyebilir
        // Gizli Oynatma Listelerini Sadece Sahibi Görüntüleyebilir
        return $playlist->view_type !== ViewType::PRIVATE->value || self::isOwner($auth, $playlist);
    }

    public static function canList(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Herkese Açık Oynatma Listelerini Herkes Listeleyebilir
        // Diğerlerini Sadece Sahipleri Listeleyebilir
        return $playlist->view_type === ViewType::PUBLIC->value || self::isOwner($auth, $playlist);
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapan Herkes Oynatma Listesi Oluşturabilir
        return $auth !== null;
    }

    public static function canEdit(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Düzenleyebilir
        return self::isOwner($auth, $playlist);
    }

    public static function canDelete(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Silebilir
        return self::isOwner($auth, $playlist);
    }

    // --------------------------------------------------------------------------
    // HELPERS
    // --------------------------------------------------------------------------

    private static function isOwner(?AuthDTO $auth, Playlist $playlist): bool
    {
        return $auth !== null && $auth->user->active_channel_id === $playlist->channel_id;
    }
}
