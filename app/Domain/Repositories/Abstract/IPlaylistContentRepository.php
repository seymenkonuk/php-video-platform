<?php
// ============================================================================
// File:    IPlaylistContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use Generator;

use App\Domain\Models\VideoWithChannel;


interface IPlaylistContentRepository
{
    // --------------------------------------------------------------------------
    // PLAYLIST VIDEOS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen oynatma listesine ait içerik sayısını döndürür.
     *
     * @param string $playlistCode içerikleri okunacak oynatma listesi kodu.
     *
     * @return int içerik sayısı.
     */
    public function countByPlaylist(string $playlistCode): int;

    /**
     * Belirtilen oynatma listesine ait içerikleri sayfalama bilgilerine göre döndürür.
     *
     * @param string $playlistCode içerikleri okunacak oynatma listesi kodu.
     * @param int $offset atlanacak kayıt sayısı.
     * @param int $limit üretilecek maksimum içerik sayısı.
     *
     * @return Generator<int, VideoWithChannel> içerikleri üreten generator.
     */
    public function yieldByPlaylist(string $playlistCode, int $offset, int $limit): Generator;
}
