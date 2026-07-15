<?php
// ============================================================================
// File:    PlaylistsPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Channel;


use Generator;

use App\Support\ViewModels\ChannelViewModel;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Playlist\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


class PlaylistsPageViewModel extends ChannelViewModel
{
    public function __construct(
        public HeaderDTO $header,
        /** @var Generator<int, CardDTO> $playlists */
        public Generator $playlists,
        public PaginationDTO $pagination,
    ) {
        parent::__construct($header);
    }
}
