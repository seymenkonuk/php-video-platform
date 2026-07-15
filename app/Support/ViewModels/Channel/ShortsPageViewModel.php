<?php
// ============================================================================
// File:    ShortsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\ChannelViewModel;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Short\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class ShortsPageViewModel extends ChannelViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, CardDTO> $shorts */
        public Generator $shorts,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($header);
    }
}
