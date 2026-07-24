<?php
// ============================================================================
// File:    HistoryPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\DTOs\Library\HistoryHeaderDTO;
use App\Support\DTOs\Media\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class HistoryPageViewModel extends AppViewModel
{
    /** @param Generator<int, ?ListItemDTO> $videos */
    public function __construct(
        AppViewContext $context,
        public HistoryHeaderDTO $header,
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
