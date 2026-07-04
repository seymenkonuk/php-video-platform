<?php
// ============================================================================
// File:    PlaylistListItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


use App\Domain\Enums\ViewType;


readonly class PlaylistListItemDTO
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
