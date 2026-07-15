<?php
// ============================================================================
// File:    VideosPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Video\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class VideosPageViewModel extends BaseViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, CardDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
