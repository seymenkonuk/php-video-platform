<?php
// ============================================================================
// File:    WatchLaterPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\WatchLaterHeaderDTO;
use App\Support\DTOs\MediaListItemDTO;
use App\Support\DTOs\PaginationDTO;


class WatchLaterPageViewModel extends BaseViewModel
{
    public function __construct(
        public WatchLaterHeaderDTO $header,
        /** @var Generator<int, ?MediaListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
