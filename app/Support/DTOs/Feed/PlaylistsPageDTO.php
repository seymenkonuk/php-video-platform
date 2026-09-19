<?php
// ============================================================================
// File:    PlaylistsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Feed;


use Generator;

use App\Support\DTOs\Playlist\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class PlaylistsPageDTO
{
    /** @param Generator<int, CardDTO> $playlists  */
    public function __construct(
        public Generator      $playlists,
        public PaginationDTO  $pagination,
    ) {}
}
