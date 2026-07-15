<?php
// ============================================================================
// File:    PlaylistsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\ViewModels\AppViewModel;

use App\Support\DTOs\Playlist\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class PlaylistsPageViewModel extends AppViewModel
{
    public function __construct(
        /** @var Generator<int, CardDTO> $playlists */
        public Generator $playlists,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
