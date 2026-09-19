<?php
// ============================================================================
// File:    ChannelsPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Feed;


use Generator;

use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class ChannelsPageDTO
{
    /** @param Generator<int, CardDTO> $channels  */
    public function __construct(
        public Generator      $channels,
        public PaginationDTO  $pagination,
    ) {}
}
