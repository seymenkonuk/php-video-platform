<?php
// ============================================================================
// File:    Pagination.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs;


readonly class Pagination
{
    public function __construct(
        public int $currentPage,
        public int $lastPage,
        public int $perPage,
        public int $count,
        public int $total,
    ) {}

    /** @return array{
     *      current_page: int,
     *      last_page: int,
     *      per_page: int,
     *      count: int,
     *      total: int,
     * } */
    public function toArray(): array
    {
        return [
            'current_page' => $this->currentPage,
            'last_page'    => $this->lastPage,
            'per_page'     => $this->perPage,
            'count'        => $this->count,
            'total'        => $this->total,
        ];
    }
}
