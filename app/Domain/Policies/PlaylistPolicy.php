<?php
// ============================================================================
// File:    PlaylistPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


class PlaylistPolicy
{
    public static function canView(/*?User $auth, Playlist $playlist*/): bool
    {
        // Herkese Açık Oynatma Listelerini Herkes Görüntüleyebilir
        // Liste Dışı Oynatma Listelerini Herkes Görüntüleyebilir
        // Gizli Oynatma Listelerini Sadece Sahibi Görüntüleyebilir
        return true;
    }

    public static function canList(/*?User $auth, Playlist $playlist*/): bool
    {
        // Herkese Açık Oynatma Listelerini Herkes Listeleyebilir
        // Liste Dışı Oynatma Listelerini Kimse Listeleyemez
        // Gizli Oynatma Listelerini Kimse Listeleyemez
        return true;
    }

    public static function canCreate(/*?User $auth*/): bool
    {
        // Giriş Yapan Herkes Oynatma Listesi Oluşturabilir
        return true;
    }

    public static function canEdit(/*?User $auth, Playlist $playlist*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Düzenleyebilir
        return true;
    }

    public static function canDelete(/*?User $auth, Playlist $playlist*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Oynatma Listesini Silebilir
        return true;
    }
}
