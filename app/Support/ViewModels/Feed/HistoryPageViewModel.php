<?php
// ============================================================================
// File:    HistoryPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\HistoryHeaderDTO;
use App\Support\DTOs\MediaListItemDTO;
use App\Support\DTOs\PaginationDTO;


class HistoryPageViewModel extends BaseViewModel
{
    public function __construct(
        public HistoryHeaderDTO $header,
        /** @var Generator<int, ?MediaListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
