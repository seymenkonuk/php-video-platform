<?php
// ============================================================================
// File:    VideoPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Enums\ViewType;

use App\Domain\Models\Video;

use App\Support\DTOs\AuthDTO;


class VideoPolicy
{
    public static function canView(?AuthDTO $auth, Video $video): bool
    {
        // Herkese Açık Videoları Herkes Görüntüleyebilir
        // Liste Dışı Videoları Herkes Görüntüleyebilir
        if ($video->view_type !== ViewType::PRIVATE->value) {
            return true;
        }
        // Gizli Videoları Giriş Yapmayanlar Görüntüleyemez
        if ($auth === null) {
            return false;
        }
        // Gizli Videoları Sadece Sahibi Görüntüleyebilir
        return $auth->user->active_channel_id === $video->uploader_id;
    }

    public static function canList(?AuthDTO $auth, Video $video): bool
    {
        // Herkese Açık Videoları Herkes Listeleyebilir
        // Liste Dışı Videoları Kimse Listeleyemez
        // Gizli Videoları Kimse Listeleyemez
        return $video->view_type === ViewType::PUBLIC->value;
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapan Herkes Video Oluşturabilir
        return $auth !== null;
    }

    public static function canEdit(?AuthDTO $auth, Video $video): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if ($auth === null) {
            return false;
        }
        // Sadece Sahibi Olan Kullanıcı Videoyu Düzenleyebilir
        return $auth->user->active_channel_id === $video->uploader_id;
    }

    public static function canDelete(?AuthDTO $auth, Video $video): bool
    {
        // Sadece Sahibi Olan Kullanıcı Videoyu Silebilir
        return self::canEdit($auth, $video);
    }
}
