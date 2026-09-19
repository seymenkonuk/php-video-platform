<?php
// ============================================================================
// File:    PlaylistsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Studio;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\DTOs\Playlist\ListItemDTO;


readonly class PlaylistsPageDTO
{
    /** @param Generator<int, ListItemDTO> $playlists */
    public function __construct(
        public Generator        $playlists,
        public PaginationDTO    $pagination,
    ) {}
}
