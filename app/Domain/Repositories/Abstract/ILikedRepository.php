<?php
// ============================================================================
// File:    ILikedRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\VideoWithChannel;
use App\Domain\Models\LikedDetails;


interface ILikedRepository
{
    // --------------------------------------------------------------------------
    // LIKED HEADER
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait beğenilenler listesinin detaylarını döndürür.
     * 
     * Kanal bulunamazsa null döndürülür.
     *
     * @param string $channelCode kanal kodu.
     *
     * @return ?LikedDetails beğenilenler listesinin detayları veya null.
     */
    public function findDetailsByChannel(string $channelCode): ?LikedDetails;

    // --------------------------------------------------------------------------
    // LIKED VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanalın beğenilenler listesine ait içerik sayısını döndürür.
     *
     * @param string $channelCode beğenilenler listesi okunacak kanal kodu.
     *
     * @return int içerik sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanalın beğenilenler listesine ait içerikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode beğenilenler listesi okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum içerik sayısı.
     *
     * @return Generator<int, VideoWithChannel> içerikleri üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;
}
