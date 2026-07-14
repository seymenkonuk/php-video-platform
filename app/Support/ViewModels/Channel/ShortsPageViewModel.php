<?php
// ============================================================================
// File:    ShortsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\ChannelHeaderDTO;
use App\Support\DTOs\PaginationDTO;
use App\Support\DTOs\ShortCardDTO;


class ShortsPageViewModel extends BaseViewModel
{
    public function __construct(
        public ChannelHeaderDTO $header,
        /** @var Generator<int, ShortCardDTO> $shorts */
        public Generator $shorts,
        public PaginationDTO $pagination,
    ) {
        parent::__construct();
    }
}
