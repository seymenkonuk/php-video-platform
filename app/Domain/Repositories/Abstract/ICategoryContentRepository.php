<?php
// ============================================================================
// File:    ICategoryContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\VideoWithChannel;


interface ICategoryContentRepository
{
    // --------------------------------------------------------------------------
    // CATEGORY VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kategoriye ait herkese açık içerik sayısını döndürür.
     *
     * @param string $categoryCode içerikleri okunacak kategori kodu.
     *
     * @return int herkese açık içerik sayısı.
     */
    public function countPublicByCategory(string $categoryCode): int;

    /**
     * Belirtilen kategoriye ait herkese açık içerikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $categoryCode içerikleri okunacak kategori kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum içerik sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık içerikleri üreten generator.
     */
    public function yieldPublicByCategory(string $categoryCode, int $offset, int $limit): Generator;
}
