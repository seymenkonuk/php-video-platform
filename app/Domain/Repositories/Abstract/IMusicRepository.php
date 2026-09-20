<?php
// ============================================================================
// File:    IMusicRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Video;
use App\Domain\Models\VideoDetails;
use App\Domain\Models\VideoWithChannel;


interface IMusicRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC MUSICS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık müzik sayısını döndürür.
     *
     * @return int herkese açık müzik sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık müzikleri sayfalama bilgilerine göre döndürür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum müzik sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık müzikleri üreten generator.
     */
    public function yieldPublic(int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // CHANNEL MUSICS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait herkese açık müzik sayısını döndürür.
     *
     * @param string $channelCode müzikleri okunacak kanal kodu.
     *
     * @return int herkese açık müzik sayısı.
     */
    public function countPublicByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait herkese açık müzikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode müzikleri okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum müzik sayısı.
     *
     * @return Generator<int, VideoWithChannel> herkese açık müzikleri üreten generator.
     */
    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // STUDIO MUSICS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait tüm müziklerin sayısını döndürür.
     *
     * @param string $channelCode müzikleri okunacak kanal kodu.
     *
     * @return int müzik sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait tüm müzikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode müzikleri okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum müzik sayısı.
     *
     * @return Generator<int, VideoWithChannel> müzikleri üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen müzik koduna ait müziği döndürür.
     *
     * Müzik bulunamazsa null döndürülür.
     *
     * @param string $code aranacak müzik kodu.
     *
     * @return ?Video bulunan müzik veya null.
     */
    public function findByCode(string $code): ?Video;

    /**
     * Belirtilen müzik koduna ait müziğin detaylarını döndürür.
     * 
     * Kanal belirtilirse, kanalın müzik üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * Müzik bulunamazsa null döndürülür.
     *
     * @param string $code aranacak müzik kodu.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return ?VideoDetails bulunan müziğin detayları veya null.
     */
    public function findDetailsByCode(string $code, ?string $channelCode): ?VideoDetails;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir müzik oluşturur.
     *
     * @param array<string,mixed> $music oluşturulacak müzik.
     *
     * @return string|false müzik başarıyla oluşturulduysa müzik kodu,
     * aksi halde false.
     */
    public function create(array $music): string|false;

    /**
     * Belirtilen müziğin değerlerini günceller.
     *
     * @param string $code güncellenecek müzik kodu.
     * @param array<string,mixed> $music güncellenecek müzik verileri.
     *
     * @return bool müzik başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, array $music): bool;

    /**
     * Belirtilen müziği siler.
     *
     * @param string $code silinecek müzik kodu.
     *
     * @return bool müzik başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
