<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Video;


use Generator;

use App\Support\DTOs\Video\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\StudioViewContext;
use App\Support\ViewModels\StudioViewModel;


final readonly class IndexPageViewModel extends StudioViewModel
{
    /** @param Generator<int, ListItemDTO> $videos  */
    public function __construct(
        StudioViewContext $context,
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
