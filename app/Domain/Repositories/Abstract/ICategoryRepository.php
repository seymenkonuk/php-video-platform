<?php
// ============================================================================
// File:    ICategoryRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\CategoryDetails;
use App\Domain\Models\CategoryWithStats;


interface ICategoryRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC CATEGORIES
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kategorilerin sayısını döndürür.
     *
     * @return int herkese açık kategori sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık kategorileri sayfalama bilgilerine göre döndürür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kategori sayısı.
     *
     * @return Generator<int, CategoryWithStats> herkese açık kategorileri üreten generator.
     */
    public function yieldPublic(int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kategori koduna ait kategorinin detaylarını döndürür.
     *
     * Kategori bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kategori kodu.
     *
     * @return ?CategoryDetails bulunan kategorinin detayları veya null.
     */
    public function findDetailsByCode(string $code): ?CategoryDetails;
}
