<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Short;


use Generator;

use App\Support\ViewModels\StudioViewModel;

use App\Support\DTOs\Short\ListItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


class IndexPageViewModel extends StudioViewModel
{
    public function __construct(
        /** @var Generator<int, ListItemDTO> $shorts  */
        public Generator $shorts,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
