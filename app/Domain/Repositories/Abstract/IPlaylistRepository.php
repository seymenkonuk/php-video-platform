<?php
// ============================================================================
// File:    IPlaylistRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Playlist;
use App\Domain\Models\PlaylistDetails;
use App\Domain\Models\PlaylistWithChannel;


interface IPlaylistRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC PLAYLISTS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık oynatma listelerinin sayısını döndürür.
     *
     * @return int herkese açık oynatma listesi sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık oynatma listelerini sayfalama bilgilerine göre döndürür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum oynatma listesi sayısı.
     *
     * @return Generator<int, PlaylistWithChannel> herkese açık oynatma listelerini üreten generator.
     */
    public function yieldPublic(int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // CHANNEL PLAYLISTS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait herkese açık oynatma listelerinin sayısını döndürür.
     *
     * @param string $channelCode oynatma listeleri okunacak kanal kodu.
     *
     * @return int herkese açık oynatma listesi sayısı.
     */
    public function countPublicByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait herkese açık oynatma listelerini sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode oynatma listeleri okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum oynatma listesi sayısı.
     *
     * @return Generator<int, PlaylistWithChannel> herkese açık oynatma listelerini üreten generator.
     */
    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // STUDIO PLAYLISTS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanala ait tüm oynatma listelerinin sayısını döndürür.
     *
     * @param string $channelCode oynatma listeleri okunacak kanal kodu.
     *
     * @return int oynatma listesi sayısı.
     */
    public function countByChannel(string $channelCode): int;

    /**
     * Belirtilen kanala ait tüm oynatma listelerini sayfalama bilgilerine göre döndürür.
     *
     * @param string $channelCode oynatma listeleri okunacak kanal kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum oynatma listesi sayısı.
     *
     * @return Generator<int, PlaylistWithChannel> oynatma listelerini üreten generator.
     */
    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen oynatma listesi koduna ait oynatma listesini döndürür.
     *
     * Oynatma listesi bulunamazsa null döndürülür.
     *
     * @param string $code aranacak oynatma listesi kodu.
     *
     * @return ?Playlist bulunan oynatma listesi veya null.
     */
    public function findByCode(string $code): ?Playlist;

    /**
     * Belirtilen oynatma listesi koduna ait oynatma listesinin detaylarını döndürür.
     *
     * Oynatma listesi bulunamazsa null döndürülür.
     *
     * @param string $code aranacak oynatma listesi kodu.
     *
     * @return ?PlaylistDetails bulunan oynatma listesinin detayları veya null.
     */
    public function findDetailsByCode(string $code): ?PlaylistDetails;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir oynatma listesi oluşturur.
     *
     * @param array<string,mixed> $playlist oluşturulacak oynatma listesi.
     *
     * @return string|false oynatma listesi başarıyla oluşturulduysa oynatma listesinin,
     * aksi halde false.
     */
    public function create(array $playlist): string|false;

    /**
     * Belirtilen oynatma listesinin değerlerini günceller.
     *
     * @param string $code güncellenecek oynatma listesi kodu.
     * @param array<string,mixed> $playlist güncellenecek oynatma listesi verileri.
     *
     * @return bool oynatma listesi başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, array $playlist): bool;

    /**
     * Belirtilen oynatma listesini siler.
     *
     * @param string $code silinecek oynatma listesi kodu.
     *
     * @return bool oynatma listesi başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
