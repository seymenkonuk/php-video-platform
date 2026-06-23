<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Video\Index;


use Generator;

use App\Support\DTOs\VideoCardDTO;
use App\Support\DTOs\PaginationDTO;


class IndexPageViewModel
{
    public function __construct(
        /** @var Generator<int, VideoCardDTO> $videos  */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
