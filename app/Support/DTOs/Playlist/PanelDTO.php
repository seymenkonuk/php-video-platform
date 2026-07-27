<?php
// ============================================================================
// File:    PanelDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use Generator;

use App\Domain\Enums\ViewType;
use App\Support\DTOs\Channel\ChannelDTO;


readonly class PanelDTO
{
    /** @param Generator<int, ItemDTO> $items */
    public function __construct(
        public string       $url,
        public string       $title,
        public ChannelDTO   $channel,
        public int          $currentIndex,
        public int          $videoCount,
        public ViewType     $viewType,
        public Generator    $items,
    ) {}
}
