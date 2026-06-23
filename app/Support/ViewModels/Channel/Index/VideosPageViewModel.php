<?php
// ============================================================================
// File:    VideosPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel\Index;


use Generator;

use App\Support\DTOs\ChannelHeaderDTO;
use App\Support\DTOs\PaginationDTO;
use App\Support\DTOs\VideoCardDTO;


class VideosPageViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
        /** @var Generator<int, VideoCardDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
