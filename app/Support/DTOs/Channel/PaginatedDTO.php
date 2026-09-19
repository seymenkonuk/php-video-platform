<?php
// ============================================================================
// File:    PaginatedDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Channel;


use Generator;

use App\Support\DTOs\UI\PaginationDTO;


readonly class PaginatedDTO
{
    /** @param Generator<int, CardDTO> $channels  */
    public function __construct(
        public PaginationDTO  $pagination,
        public Generator      $channels,
    ) {}
}
