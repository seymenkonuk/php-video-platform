<?php
// ============================================================================
// File:    WatchLaterPageDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Feed;


use Generator;

use App\Support\DTOs\Library\WatchLaterHeaderDTO;
use App\Support\DTOs\Playlist\ItemDTO;
use App\Support\DTOs\UI\PaginationDTO;


readonly class WatchLaterPageDTO
{
    /** @param Generator<int, ?ItemDTO> $videos  */
    public function __construct(
        public WatchLaterHeaderDTO  $header,
        public Generator            $videos,
        public PaginationDTO        $pagination,
    ) {}
}
