<?php
// ============================================================================
// File:    PaginationDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


readonly class PaginationDTO
{
    public function __construct(
        public int $currentPage,
        public int $lastPage,
        public int $perPage,
        public int $count,
        public int $total,
    ) {}
}
