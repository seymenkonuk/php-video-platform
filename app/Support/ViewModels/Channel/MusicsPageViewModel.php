<?php
// ============================================================================
// File:    MusicsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\DTOs\Music\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewModels\ChannelViewModel;


final readonly class MusicsPageViewModel extends ChannelViewModel
{
    /** @param Generator<int, CardDTO> $musics */
    public function __construct(
        ChannelViewContext $context,
        public Generator $musics,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
