<?php
// ============================================================================
// File:    IVideoRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Video;
use App\Domain\Models\VideoDetails;
use App\Domain\Models\VideoWithChannel;


interface IVideoRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık video sayısını döndürür.
     *
     * @return int herkese açık video sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık videoları sayfalama bilgilerine göre döndürür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum video sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık videoları üreten generator.
     */
    public function yieldPublic(int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // CHANNEL VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait herkese açık video sayısını döndürür.
     *
     * @param string $channelCode videoları okunacak kanal kodu.
     *
     * @return int herkese açık video sayısı.
     */
    public function countPublicByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait herkese açık videoları sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode videoları okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum video sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık videoları üreten generator.
     */
    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // STUDIO VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait tüm videoların sayısını döndürür.
     *
     * @param string $channelCode videoları okunacak kanal kodu.
     *
     * @return int video sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait tüm videoları sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode videoları okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum video sayısı.
     *
     * @return Generator<int, VideoWithChannel> videoları üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen video koduna ait videoyu döndürür.
     *
     * Video bulunamazsa null döndürülür.
     *
     * @param string $code aranacak video kodu.
     *
     * @return ?Video bulunan video veya null.
     */
    public function findByCode(string $code): ?Video;

    /**
     * Belirtilen video koduna ait videonun detaylarını döndürür.
     * 
     * Kanal belirtilirse, kanalın video üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * Video bulunamazsa null döndürülür.
     *
     * @param string $code aranacak video kodu.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return ?VideoDetails bulunan videonun detayları veya null.
     */
    public function findDetailsByCode(string $code, ?string $channelCode): ?VideoDetails;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir video oluşturur.
     *
     * @param Video $video oluşturulacak video.
     *
     * @return string|false video başarıyla oluşturulduysa video kodu,
     * aksi halde false.
     */
    public function create(Video $video): string|false;

    /**
     * Belirtilen videonun değerlerini günceller.
     *
     * @param string $code güncellenecek video kodu.
     * @param Video $video güncellenecek video verileri.
     *
     * @return bool video başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, Video $video): bool;

    /**
     * Belirtilen videoyu siler.
     *
     * @param string $code silinecek video kodu.
     *
     * @return bool video başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
