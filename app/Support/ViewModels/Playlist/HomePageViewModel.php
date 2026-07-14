<?php
// ============================================================================
// File:    HomePageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Playlist;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\PlaylistHeaderDTO;
use App\Support\DTOs\MediaListItemDTO;
use App\Support\DTOs\PaginationDTO;


class HomePageViewModel extends BaseViewModel
{
    public function __construct(
        public PlaylistHeaderDTO $header,
        /** @var Generator<int, ?MediaListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
