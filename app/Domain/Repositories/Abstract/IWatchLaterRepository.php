<?php
// ============================================================================
// File:    IWatchLaterRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\VideoWithChannel;
use App\Domain\Models\WatchLaterDetails;


interface IWatchLaterRepository
{
    // --------------------------------------------------------------------------
    // WATCH LATER HEADER
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait daha sonra izle listesinin detaylarını döndürür.
     * 
     * Kanal bulunamazsa null döndürülür.
     *
     * @param string $channelCode kanal kodu.
     *
     * @return ?WatchLaterDetails daha sonra izle listesinin detayları veya null.
     */
    public function findDetailsByChannel(string $channelCode): ?WatchLaterDetails;

    // --------------------------------------------------------------------------
    // WATCH LATER VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanalın daha sonra izle listesine ait içerik sayısını döndürür.
     *
     * @param string $channelCode daha sonra izle listesi okunacak kanal kodu.
     *
     * @return int içerik sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanalın daha sonra izle listesine ait içerikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode daha sonra izle listesi okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum içerik sayısı.
     *
     * @return Generator<int, VideoWithChannel> içerikleri üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;
}
