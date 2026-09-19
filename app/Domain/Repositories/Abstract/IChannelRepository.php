<?php
// ============================================================================
// File:    IChannelRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\Channel;
use App\Domain\Models\ChannelDetails;
use App\Domain\Models\ChannelWithStats;


interface IChannelRepository
{
    // --------------------------------------------------------------------------
    // PUBLIC CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kanal sayısını döndürür.
     *
     * @return int herkese açık kanal sayısı.
     */
    public function countPublic(): int;

    /**
     * Herkese açık kanalları sayfalama bilgilerine göre döndürür.
     * 
     * Kanal belirtilirse, kanalın kanallar üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kanal sayısı.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return Generator<int, ChannelDetails> herkese açık kanalları üreten generator.
     */
    public function yieldPublic(int $offset, int $limit, ?string $channelCode): Generator;

    // --------------------------------------------------------------------------
    // SUBSCRIBED CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanalın abone olduğu kanal sayısını döndürür.
     *
     * @param string $subscriberCode abonelikleri okunacak kanal kodu.
     *
     * @return int herkese açık kanal sayısı.
     */
    public function countPublicBySubscriber(string $subscriberCode): int;

    /**
     * Belirtilen kanalın abone olduğu kanalları sayfalama bilgilerine göre döndürür.
     * 
     * Kanal belirtilirse, kanalın kanallar üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kanal sayısı.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return Generator<int, ChannelDetails> herkese açık kanalları üreten generator.
     */
    public function yieldPublicBySubscriber(string $subscriberCode, int $offset, int $limit, ?string $channelCode): Generator;

    // --------------------------------------------------------------------------
    // STUDIO CHANNELS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kullanıcıya ait tüm kanalların sayısını döndürür.
     *
     * @param string $userCode kanalları okunacak kullanıcı kodu.
     *
     * @return int kanal sayısı.
     */
    public function countByUser(string $userCode): int;

    /**
     * Belirtilen kullanıcıya ait tüm kanalları sayfalama bilgilerine göre döndürür.
     *
     * @param string $userCode kanalları okunacak kullanıcı kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum kanal sayısı.
     *
     * @return Generator<int, ChannelWithStats> kanalları üreten generator.
     */
    public function yieldByUser(string $userCode, int $offset, int $limit): Generator;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kanal ismine ait kanalın mevcut olup olmadığını döndürür.
     *
     * @param string $name kontrol edilecek kanal ismi.
     *
     * @return bool kanal mevcutsa true, aksi halde false.
     */
    public function existsByName(string $name): bool;

    /**
     * Belirtilen kanal id'sine ait kanalı döndürür.
     *
     * Kanal bulunamazsa null döndürülür.
     *
     * @param int $id aranacak kanal id'si.
     *
     * @return ?Channel bulunan kanal veya null.
     */
    public function findById(int $id): ?Channel;

    /**
     * Belirtilen kanal koduna ait kanalı döndürür.
     *
     * Kanal bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kanal kodu.
     *
     * @return ?Channel bulunan kanal veya null.
     */
    public function findByCode(string $code): ?Channel;

    /**
     * Belirtilen kanal koduna ait kanalın detaylarını döndürür.
     * 
     * Kanal belirtilirse, kanalın kanal üzerindeki etkileşim
     * durumları da döndürülür.
     *
     * Kanal bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kanal kodu.
     * @param ?string $channelCode mevcut kanal kodu. oturum açık değilse null.
     *
     * @return ?ChannelDetails bulunan kanalın detayları veya null.
     */
    public function findDetailsByCode(string $code, ?string $channelCode): ?ChannelDetails;

    /**
     * Belirtilen kanal koduna ait kanalın istatistiklerini döndürür.
     * 
     * Kanal bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kanal kodu.
     *
     * @return ?ChannelWithStats bulunan kanalın istatistikleri veya null.
     */
    public function findStatisticsByCode(string $code): ?ChannelWithStats;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir kanal oluşturur.
     *
     * @param Channel $channel oluşturulacak kanal.
     *
     * @return string|false kanal başarıyla oluşturulduysa kanal kodu,
     * aksi halde false.
     */
    public function create(Channel $channel): string|false;

    /**
     * Belirtilen kanalın değerlerini günceller.
     *
     * @param string $code güncellenecek kanal kodu.
     * @param Channel $channel güncellenecek kanal verileri.
     *
     * @return bool kanal başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, Channel $channel): bool;

    /**
     * Belirtilen kanalı siler.
     *
     * @param string $code silinecek kanal kodu.
     *
     * @return bool kanal başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
