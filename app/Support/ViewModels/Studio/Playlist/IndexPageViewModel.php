<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Playlist;


use Generator;

use App\Support\ViewModels\StudioViewModel;

use App\Support\DTOs\Playlist\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


class IndexPageViewModel extends StudioViewModel
{
    public function __construct(
        /** @var Generator<int, ListItemDTO> $playlists  */
        public Generator $playlists,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
