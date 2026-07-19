<?php
// ============================================================================
// File:    ItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Comment;


use App\Support\DTOs\Channel\ChannelDTO;


readonly class ItemDTO
{
    public function __construct(
        public string       $url,
        public string       $message,
        public bool         $edited,
        public ChannelDTO   $channel,
        public bool         $liked,
        public int          $likeCount,
        public string       $likeCountFormatted,
        public bool         $disliked,
        public int          $dislikeCount,
        public string       $dislikeCountFormatted,
        public string       $date,
        public string       $dateFormatted,
    ) {}
}
