<?php
// ============================================================================
// File:    PageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Music;


use App\Support\DTOs\Comment\ListDTO;


readonly class PageDTO
{
    public function __construct(
        public DetailsDTO $music,
        public ListDTO $commentList,
    ) {}
}
