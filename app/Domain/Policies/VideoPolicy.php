<?php
// ============================================================================
// File:    VideoPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


class VideoPolicy
{
    public static function canView(/*?User $auth, Video $video*/): bool
    {
        // Herkese Açık Videoları Herkes Görüntüleyebilir
        // Liste Dışı Videoları Herkes Görüntüleyebilir
        // Gizli Videoları Sadece Sahibi Görüntüleyebilir
        return true;
    }

    public static function canList(/*?User $auth, Video $video*/): bool
    {
        // Herkese Açık Videoları Herkes Listeleyebilir
        // Liste Dışı Videoları Kimse Listeleyemez
        // Gizli Videoları Kimse Listeleyemez
        return true;
    }

    public static function canCreate(/*?User $auth*/): bool
    {
        // Giriş Yapan Herkes Video Oluşturabilir
        return true;
    }

    public static function canEdit(/*?User $auth, Video $video*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Videoyu Düzenleyebilir
        return true;
    }

    public static function canDelete(/*?User $auth, Video $video*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Videoyu Silebilir
        return true;
    }
}
