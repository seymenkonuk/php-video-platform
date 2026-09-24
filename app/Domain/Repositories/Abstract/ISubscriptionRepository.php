<?php
// ============================================================================
// File:    ISubscriptionRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\VideoWithChannel;


interface ISubscriptionRepository
{
    // --------------------------------------------------------------------------
    // SUBSCRIPTION VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanalın abone olduğu kanallara ait herkese açık içerik sayısını döndürür.
     *
     * @param string $subscriberCode abonelikleri okunacak kanal kodu.
     *
     * @return int herkese açık içerik sayısı.
     */
    public function countPublicBySubscriber(string $subscriberCode): int;

    /**
     * Belirtilen kanalın abone olduğu kanallara ait herkese açık içerikleri
     * sayfalama bilgilerine göre döndürür.
     *
     * @param string $subscriberCode abonelikleri okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum içerik sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık içerikleri üreten generator.
     */
    public function yieldPublicBySubscriber(
        string $subscriberCode,
        int $offset,
        int $limit
    ): Generator;
}
