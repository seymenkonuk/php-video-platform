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
        // Herkese Açık Oynatma Listelerini Herkes Görüntüleyebilir
        // Liste Dışı Oynatma Listelerini Herkes Görüntüleyebilir
        if ($playlist->view_type !== ViewType::PRIVATE->value) {
            return true;
        }
        // Gizli Oynatma Listelerini Giriş Yapmayanlar Görüntüleyemez
        if ($auth === null) {
            return false;
        }
        // Gizli Oynatma Listelerini Sadece Sahibi Görüntüleyebilir
        return $auth->user->active_channel_id === $playlist->channel_id;
    }

    public static function canList(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Herkese Açık Oynatma Listelerini Herkes Listeleyebilir
        // Liste Dışı Oynatma Listelerini Kimse Listeleyemez
        // Gizli Oynatma Listelerini Kimse Listeleyemez
        return $playlist->view_type === ViewType::PUBLIC->value;
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapan Herkes Oynatma Listesi Oluşturabilir
        return $auth !== null;
    }

    public static function canEdit(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if ($auth === null) {
            return false;
        }
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Düzenleyebilir
        return $auth->user->active_channel_id === $playlist->channel_id;
    }

    public static function canDelete(?AuthDTO $auth, Playlist $playlist): bool
    {
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Silebilir
        return self::canEdit($auth, $playlist);
    }
}
