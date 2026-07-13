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
        // Giriş Yapmayan Düzenleyemez
        if ($auth === null) {
            return false;
        }
        // Sadece Kullanıcının Kendisi Hesabını Düzenleyebilir
        return $auth->user->id === $user->id;
    }

    public static function canDelete(?AuthDTO $auth, User $user): bool
    {
        // Sadece Kullanıcının Kendisi Hesabını Silebilir
        return self::canEdit($auth, $user);
    }
}
