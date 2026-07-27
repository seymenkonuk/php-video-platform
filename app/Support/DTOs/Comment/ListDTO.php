<?php
// ============================================================================
// File:    ListDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Comment;


use Generator;

use App\Support\DTOs\Comment\ItemDTO;


readonly class ListDTO
{
    /** @param Generator<int, ItemDTO> $comments */
    public function __construct(
        public string $data,
        public bool $enabled,
        public bool $loggedIn,
        public bool $allowed,
        public Generator $comments,
        public int $count,
        public string $countFormatted,
    ) {}
}
