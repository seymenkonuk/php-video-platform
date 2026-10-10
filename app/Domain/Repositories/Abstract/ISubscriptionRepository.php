<?php
// ============================================================================
// File:    ISubscriptionRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Subscription;
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

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * İki kanal arasındaki abonelik detaylarını getirir.
     * 
     * Abonelik bulunamazsa null döndürülür.
     *
     * @param int $subscriberId abone olan kanal id'si.
     * @param int $subscribedId abone olunan kanal id'si.
     *
     * @return ?Subscription abonelik detayları veya null.
     */
    public function findDetailsByIds(int $subscriberId, int $subscribedId): ?Subscription;
    
    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir abonelik oluşturur.
     *
     * @param array<string,mixed> $subscription oluşturulacak abonelik bilgileri.
     *
     * @return string|false abonelik başarıyla oluşturulduysa metin,
     * aksi halde false.
     */
    public function create(array $subscription): string|false;

    /**
     * İki kanal arasındaki aboneliği siler.
     *
     * @param int $subscriberId abone olan kanal id'si.
     * @param int $subscribedId abone olunan kanal id'si.
     *
     * @return bool abonelik başarıyla silindiyse true, aksi halde false.
     */
    public function deleteByIds(int $subscriberId, int $subscribedId): bool;
}
