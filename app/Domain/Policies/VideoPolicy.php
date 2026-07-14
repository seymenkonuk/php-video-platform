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
        // Gizli Olmayan Videoları Herkes Görüntüleyebilir
        // Gizli Videoları Sadece Sahibi Görüntüleyebilir
        return ($video->view_type !== ViewType::PRIVATE->value) || self::isOwner($auth, $video);
    }

    public static function canList(?AuthDTO $auth, Video $video): bool
    {
        // "Herkese Açık" Videoları Herkes Listeleyebilir
        return ($video->view_type === ViewType::PUBLIC->value);
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapan Herkes Video Oluşturabilir
        return $auth !== null;
    }

    public static function canEdit(?AuthDTO $auth, Video $video): bool
    {
        // Sadece Sahibi Düzenleyebilir
        return self::isOwner($auth, $video);
    }

    public static function canDelete(?AuthDTO $auth, Video $video): bool
    {
        // Sadece Sahibi Silebilir
        return self::isOwner($auth, $video);
    }

    // --------------------------------------------------------------------------
    // HELPERS
    // --------------------------------------------------------------------------

    private static function isOwner(?AuthDTO $auth, Video $video): bool
    {
        return $auth !== null && $auth->user->active_channel_id === $video->uploader_id;
    }
}
