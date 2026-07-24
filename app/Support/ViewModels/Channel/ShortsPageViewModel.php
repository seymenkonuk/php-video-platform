<?php
// ============================================================================
// File:    ShortsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\DTOs\Short\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewModels\ChannelViewModel;


final readonly class ShortsPageViewModel extends ChannelViewModel
{
    /** @param Generator<int, CardDTO> $shorts */
    public function __construct(
        ChannelViewContext $context,
        public Generator $shorts,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
