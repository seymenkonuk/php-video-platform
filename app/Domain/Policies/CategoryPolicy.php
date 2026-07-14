<?php
// ============================================================================
// File:    CategoryPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Policies;


use App\Domain\Models\Category;

use App\Support\DTOs\AuthDTO;


class CategoryPolicy
{
    public static function canView(?AuthDTO $auth, Category $category): bool
    {
        // Herkes Tüm Kategorileri Görüntüleyebilir
        return true;
    }

    public static function canList(?AuthDTO $auth, Category $category): bool
    {
        // Herkes Tüm Kategorileri Listeleyebilir
        return true;
    }

    public static function canCreate(?AuthDTO $auth): bool
    {
        // Kimse Kategori Oluşturamaz
        return false;
    }

    public static function canEdit(?AuthDTO $auth, Category $category): bool
    {
        // Kimse Kategorileri Düzenleyemez
        return false;
    }

    public static function canDelete(?AuthDTO $auth, Category $category): bool
    {
        // Kimse Kategorileri Silemez
        return false;
    }
}
