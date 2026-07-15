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

use App\Support\DTOs\Playlist\HeaderDTO;
use App\Support\DTOs\Media\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


class HomePageViewModel extends BaseViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, ?ListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
