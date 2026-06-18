<?php
// ============================================================================
// File:    UserPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


class UserPolicy
{
    public static function canView(/*?User $auth, User $user*/): bool
    {
        // Herkes Kullanıcıları Görüntüleyebilir
        return true;
    }

    public static function canList(/*?User $auth, User $user*/): bool
    {
        // Kimse Kullanıcıları Listeleyemez
        return true;
    }

    public static function canCreate(/*?User $auth*/): bool
    {
        // Giriş Yapmayan Herkes Kullanıcı Oluşturabilir
        return true;
    }

    public static function canEdit(/*?User $auth, User $user*/): bool
    {
        // Sadece Kullanıcının Kendisi Hesabını Düzenleyebilir
        return true;
    }

    public static function canDelete(/*?User $auth, User $user*/): bool
    {
        // Sadece Kullanıcının Kendisi Hesabını Silebilir
        return true;
    }
}
