<?php
// ============================================================================
// File:    DetailsViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Video;


use Generator;

use App\Support\DTOs\Playlist\OptionDTO;
use App\Support\DTOs\Video\DetailsDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class DetailsViewProp extends BaseViewProp
{
    /** @param Generator<int, OptionDTO> $playlists */
    public function __construct(
        public DetailsDTO $video,
        public Generator $playlists,
    ) {}
}
