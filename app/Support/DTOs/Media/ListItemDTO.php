<?php
// ============================================================================
// File:    ListItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Media;


use App\Domain\Enums\VideoType;

use App\Support\DTOs\Channel\ChannelDTO;


readonly class ListItemDTO
{
    public function __construct(
        public VideoType    $type,
        public ?int         $order,
        public string       $url,
        public string       $title,
        public string       $thumbnail,
        public ChannelDTO   $channel,
        public int          $duration,
        public string       $durationFormatted,
        public int          $viewCount,
        public string       $viewCountFormatted,
        public string       $date,
        public string       $dateFormatted,
    ) {}
}
