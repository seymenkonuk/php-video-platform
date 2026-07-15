<?php
// ============================================================================
// File:    ListItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Short;


use App\Domain\Enums\VideoType;

use App\Support\DTOs\Channel\ChannelDTO;
use App\Support\DTOs\Media\ListItemDTO as MediaListItemDTO;


readonly class ListItemDTO extends MediaListItemDTO
{
    public function __construct(
        ?int         $order,
        string       $url,
        string       $title,
        string       $thumbnail,
        ChannelDTO   $channel,
        int          $duration,
        string       $durationFormatted,
        int          $viewCount,
        string       $viewCountFormatted,
        string       $date,
        string       $dateFormatted,
    ) {
        parent::__construct(
            VideoType::SHORT,
            $order,
            $url,
            $title,
            $thumbnail,
            $channel,
            $duration,
            $durationFormatted,
            $viewCount,
            $viewCountFormatted,
            $date,
            $dateFormatted
        );
    }
}
