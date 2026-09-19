<?php
// ============================================================================
// File:    PaginatedDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Music;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;


readonly class PaginatedDTO
{
    /** @param Generator<int, CardDTO> $musics  */
    public function __construct(
        public Generator      $musics,
        public PaginationDTO  $pagination,
    ) {}
}
