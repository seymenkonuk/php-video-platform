<?php
// ============================================================================
// File:    CommentsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Feed;


use Generator;

use App\Support\DTOs\Comment\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class CommentsPageDTO
{
    /** @param Generator<int, CardDTO> $comments  */
    public function __construct(
        public PaginationDTO  $pagination,
        public Generator      $comments,
    ) {}
}
