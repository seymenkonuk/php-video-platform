<?php
// ============================================================================
// File:    PlaylistsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\DTOs\Playlist\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewContexts\ChannelViewContext;
use App\Support\ViewModels\ChannelViewModel;


final readonly class PlaylistsPageViewModel extends ChannelViewModel
{
    /** @param Generator<int, CardDTO> $playlists */
    public function __construct(
        ChannelViewContext $context,
        public Generator $playlists,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($context);
    }
}
