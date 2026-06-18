<?php
// ============================================================================
// File:    CommentPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


class CommentPolicy
{
    public static function canView(/*?User $auth, Comment $comment*/): bool
    {
        return true;
    }

    public static function canList(/*?User $auth, Comment $comment*/): bool
    {
        return true;
    }

    public static function canCreate(/*?User $auth*, Media $media/): bool
    {
        // Medyaya Yorum Yapma İzni Var Mı Kontrol Et
        return true;
    }

    public static function canEdit(/*?User $auth, Comment $comment*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Yorumu Düzenleyebilir
        return true;
    }

    public static function canDelete(/*?User $auth, Comment $comment*/): bool
    {
        // Sadece Sahibi Olan Kullanıcı Yorumu Silebilir
        return true;
    }
}
