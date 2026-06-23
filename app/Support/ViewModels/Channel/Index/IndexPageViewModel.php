<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel\Index;


use Generator;

use App\Support\DTOs\ChannelCardDTO;
use App\Support\DTOs\PaginationDTO;


class IndexPageViewModel
{
    public function __construct(
        /** @var Generator<int, ChannelCardDTO> $channels  */
        public Generator $channels,
        public PaginationDTO $pagination,
    ) {}
}
