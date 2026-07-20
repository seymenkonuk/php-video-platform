<?php
// ============================================================================
// File:    DetailsDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Video;


use App\Support\DTOs\Channel\DetailsDTO as ChannelDetailsDTO;


readonly class DetailsDTO
{
    public function __construct(
        public string               $url,
        public string               $title,
        public ?string              $description,
        public string               $thumbnail,
        public string               $sourceUrl,
        public ChannelDetailsDTO    $channel,
        public int                  $viewCount,
        public string               $viewCountFormatted,
        public string               $date,
        public string               $dateFormatted,
        public bool                 $liked,
        public int                  $likeCount,
        public string               $likeCountFormatted,
        public bool                 $disliked,
        public int                  $dislikeCount,
        public string               $dislikeCountFormatted,
        public bool                 $inWatchLater,
    ) {}
}
