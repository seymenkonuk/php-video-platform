<?php
// ============================================================================
// File:    InteractionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Short;


readonly class InteractionDTO
{
    public function __construct(
        public bool     $liked,
        public int      $likeCount,
        public string   $likeCountFormatted,
        public bool     $disliked,
        public int      $dislikeCount,
        public string   $dislikeCountFormatted,
    ) {}
}
