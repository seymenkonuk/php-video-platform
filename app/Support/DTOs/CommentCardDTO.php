<?php
// ============================================================================
// File:    CommentCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


readonly class CommentCardDTO
{
    public function __construct(
        public ?string      $url,
        public string       $message,
        public ChannelDTO   $channel,
        public int          $likeCount,
        public string       $likeCountFormatted,
        public int          $dislikeCount,
        public string       $dislikeCountFormatted,
        public string       $date,
        public string       $dateFormatted,
    ) {}
}
