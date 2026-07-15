<?php
// ============================================================================
// File:    ListItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use App\Domain\Enums\ViewType;

use App\Support\DTOs\Channel\ChannelDTO;


readonly class ListItemDTO
{
    public function __construct(
        public ?int         $order,
        public string       $url,
        public string       $title,
        public string       $banner,
        public ChannelDTO   $channel,
        public int          $videoCount,
        public string       $videoCountFormatted,
        public ViewType     $viewType,
    ) {}
}
