<?php
// ============================================================================
// File:    IShortRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Video;
use App\Domain\Models\VideoDetails;
use App\Domain\Models\VideoWithChannel;


interface IShortRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC SHORTS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kısa video sayısını döndürür.
     *
     * @return int herkese açık kısa video sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık kısa videoları sayfalama bilgilerine göre döndürür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kısa video sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık kısa videoları üreten generator.
     */
    public function yieldPublic(int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // CHANNEL SHORTS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait herkese açık kısa video sayısını döndürür.
     *
     * @param string $channelCode kısa videoları okunacak kanal kodu.
     *
     * @return int herkese açık kısa video sayısı.
     */
    public function countPublicByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait herkese açık kısa videoları sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode kısa videoları okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kısa video sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık kısa videoları üreten generator.
     */
    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // STUDIO SHORTS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait tüm kısa videoların sayısını döndürür.
     *
     * @param string $channelCode kısa videoları okunacak kanal kodu.
     *
     * @return int kısa video sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait tüm kısa videoları sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode kısa videoları okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kısa video sayısı.
     *
     * @return Generator<int, VideoWithChannel> kısa videoları üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kısa video koduna ait kısa videoyu döndürür.
     *
     * Video bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kısa video kodu.
     *
     * @return ?Video bulunan kısa video veya null.
     */
    public function findByCode(string $code): ?Video;

    /**
     * Belirtilen kısa video koduna ait kısa videonun detaylarını döndürür.
     * 
     * Kanal belirtilirse, kanalın kısa video üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * Kısa video bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kısa video kodu.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return ?VideoDetails bulunan kısa videonun detayları veya null.
     */
    public function findDetailsByCode(string $code, ?string $channelCode): ?VideoDetails;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir kısa video oluşturur.
     *
     * @param array<string,mixed> $short oluşturulacak kısa video.
     *
     * @return string|false kısa video başarıyla oluşturulduysa kısa video kodu,
     * aksi halde false.
     */
    public function create(array $short): string|false;

    /**
     * Belirtilen kısa videonun değerlerini günceller.
     *
     * @param string $code güncellenecek kısa video kodu.
     * @param array<string,mixed> $short güncellenecek kısa video verileri.
     *
     * @return bool kısa video başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, array $short): bool;

    /**
     * Belirtilen kısa videoyu siler.
     *
     * @param string $code silinecek kısa video kodu.
     *
     * @return bool kısa video başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
