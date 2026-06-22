<?php
// ============================================================================
// File:    CategoryPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Models\Category;
use App\Domain\Models\User;


class CategoryPolicy
{
    public static function canView(?User $auth, Category $category): bool
    {
        // Herkes Tüm Kategorileri Görüntüleyebilir
        return true;
    }

    public static function canList(?User $auth, Category $category): bool
    {
        // Herkes Tüm Kategorilerin Listesine Erişebilir
        return true;
    }

    public static function canCreate(?User $auth): bool
    {
        // Kimse Kategori Oluşturamaz
        return false;
    }

    public static function canEdit(?User $auth, Category $category): bool
    {
        // Kimse Kategorileri Düzenleyemez
        return false;
    }

    public static function canDelete(?User $auth, Category $category): bool
    {
        // Kimse Kategorileri Silemez
        return false;
    }
}
