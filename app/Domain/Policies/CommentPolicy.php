<?php
// ============================================================================
// File:    CommentPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Enums\CommentType;

use App\Domain\Models\Comment;
use App\Domain\Models\Video;

use App\Support\DTOs\AuthDTO;


class CommentPolicy
{
    public static function canView(?AuthDTO $auth, Comment $comment): bool
    {
        return true;
    }

    public static function canList(?AuthDTO $auth, Video $video): bool
    {
        // Yorum Yapılabilir ise Herkes Listeyelebilir
        if ($video->comment_type === CommentType::ALLOW->value) {
            return true;
        }
        // Yorumlar Kapalıysa Giriş Yapmayanlar Listeleyemez
        if ($auth === null) {
            return false;
        }
        // Yorumlar Kapalıysa Eski Yorumları Sadece Video Sahibi Listeleyebilir
        return $auth->user->active_channel_id === $video->uploader_id;
    }

    public static function canCreate(?AuthDTO $auth, Video $video): bool
    {
        // Giriş Yapmayan Yorum Yapamaz
        if ($auth === null) {
            return false;
        }
        // Videoya Yorum Yapma İzni Var Mı Kontrol Et
        if ($video->comment_type === CommentType::ALLOW->value) {
            return true;
        }
        // Video Sahibi Her Zaman Yorum Yapabilir
        return $auth->user->active_channel_id === $video->uploader_id;
    }

    public static function canEdit(?AuthDTO $auth, Comment $comment): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if ($auth === null) {
            return false;
        }
        // Sadece Sahibi Olan Kullanıcı Yorumu Düzenleyebilir
        return $auth->user->active_channel_id === $comment->commenter_id;
    }

    public static function canDelete(?AuthDTO $auth, Comment $comment): bool
    {
        // Sadece Sahibi Olan Kullanıcı Yorumu Silebilir
        return self::canEdit($auth, $comment);
    }
}
