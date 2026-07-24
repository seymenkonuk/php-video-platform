<?php
// ============================================================================
// File:    ChannelsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Feed;


use Generator;

use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class ChannelsPageViewModel extends AppViewModel
{
    /** @param Generator<int, CardDTO> $channels */
    public function __construct(
        AppViewContext $context,
        public Generator $channels,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
