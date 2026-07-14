<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Video;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\VideoListItemDTO;
use App\Support\DTOs\PaginationDTO;


class IndexPageViewModel extends BaseViewModel
{
    public function __construct(
        /** @var Generator<int, VideoListItemDTO> $videos  */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
