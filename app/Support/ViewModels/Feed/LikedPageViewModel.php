<?php
// ============================================================================
// File:    LikedPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\ViewModels\AppViewModel;

use App\Support\DTOs\Library\LikedHeaderDTO;
use App\Support\DTOs\Media\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


class LikedPageViewModel extends AppViewModel
{
    public function __construct(
        public LikedHeaderDTO $header,
        /** @var Generator<int, ?ListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
