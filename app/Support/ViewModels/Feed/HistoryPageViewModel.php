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

use App\Support\DTOs\Library\HistoryHeaderDTO;
use App\Support\DTOs\Media\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


class HistoryPageViewModel extends BaseViewModel
{
    public function __construct(
        public HistoryHeaderDTO $header,
        /** @var Generator<int, ?ListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
