<?php
// ============================================================================
// File:    UserPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Models\User;

use App\Support\DTOs\AuthDTO;


class UserPolicy
{
    public static function canView(?AuthDTO $auth, User $user): bool
    {
        // Kimse Kullanıcıları Görüntüleyemez
        return false;
    }

    public static function canList(?AuthDTO $auth, User $user): bool
    {
        // Kimse Kullanıcıları Listeleyemez
        return false;
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Giriş Yapmayan Herkes Kullanıcı Oluşturabilir
        return $auth === null;
    }

    public static function canEdit(?AuthDTO $auth, User $user): bool
    {
        // Sadece Kullanıcının Kendisi Hesabını Düzenleyebilir
        return self::isMe($auth, $user);
    }

    public static function canDelete(?AuthDTO $auth, User $user): bool
    {
        // Sadece Kullanıcının Kendisi Hesabını Silebilir
        return self::isMe($auth, $user);
    }

    // --------------------------------------------------------------------------
    // HELPERS
    // --------------------------------------------------------------------------

    private static function isMe(?AuthDTO $auth, User $user): bool
    {
        return $auth !== null && $auth->user->id === $user->id;
    }
}
