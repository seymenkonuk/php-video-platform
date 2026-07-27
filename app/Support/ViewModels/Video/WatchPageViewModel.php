<?php
// ============================================================================
// File:    WatchPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Video;


use Generator;

use App\Support\DTOs\Comment\ListDTO;
use App\Support\DTOs\Playlist\OptionDTO;
use App\Support\DTOs\Playlist\PanelDTO;
use App\Support\DTOs\Video\DetailsDTO;

use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class WatchPageViewModel extends AppViewModel
{
    /** @param Generator<int, OptionDTO> $playlists */
    public function __construct(
        AppViewContext $context,
        public DetailsDTO $video,
        public int $startTime,
        public ?string $nextUrl,
        public ListDTO $commentList,
        public Generator $playlists,
        public ?PanelDTO $activePlaylist,
    ) {
        parent::__construct($context);
    }
}
