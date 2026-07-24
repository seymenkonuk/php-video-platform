<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Music;


use Generator;

use App\Support\DTOs\Music\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\StudioViewContext;
use App\Support\ViewModels\StudioViewModel;


final readonly class IndexPageViewModel extends StudioViewModel
{
    /** @param Generator<int, ListItemDTO> $musics  */
    public function __construct(
        StudioViewContext $context,
        public Generator $musics,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
