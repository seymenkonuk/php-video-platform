<?php
// ============================================================================
// File:    ILikedRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Liked;
use App\Domain\Models\LikedDetails;
use App\Domain\Models\VideoWithChannel;


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
    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Kanalın belirtilen videoyu beğenip beğenmediğini gösteren kaydı getirir.
     * 
     * Kayıt bulunamazsa null döndürülür.
     *
     * @param int $channelId kanal id'si.
     * @param int $videoId video id'si.
     *
     * @return ?Liked kayıt veya null.
     */
    public function findDetailsByIds(int $channelId, int $videoId): ?Liked;
    
    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir beğeni kayıt oluşturur.
     *
     * @param array<string,mixed> $data oluşturulacak beğeni kaydı bilgileri.
     *
     * @return string|false başarıyla oluşturulduysa metin,
     * aksi halde false.
     */
    public function create(array $data): string|false;

    /**
     * Kanalın beğeniler listesinden belirtilen videoyu siler.
     *
     * @param int $channelId kanal id'si.
     * @param int $videoId video id'si.
     *
     * @return bool başarıyla silindiyse true, aksi halde false.
     */
    public function deleteByIds(int $channelId, int $videoId): bool;
}
