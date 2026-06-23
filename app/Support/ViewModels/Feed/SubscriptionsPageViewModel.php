<?php
// ============================================================================
// File:    SubscriptionsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\DTOs\PaginationDTO;
use App\Support\DTOs\MediaListItemDTO;


class SubscriptionsPageViewModel
{
    public function __construct(
        /** @var Generator<int, MediaListItemDTO> $videos */
        public Generator $videos,
        public PaginationDTO $pagination,
    ) {}
}
