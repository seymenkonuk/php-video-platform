<?php
// ============================================================================
// File:    DetailsViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Short;


use Generator;

use App\Support\DTOs\Playlist\OptionDTO;
use App\Support\DTOs\Short\DetailsDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class DetailsViewProp extends BaseViewProp
{
    /** @param Generator<int, OptionDTO> $playlists */
    public function __construct(
        public DetailsDTO $short,
        public Generator $playlists,
    ) {}
}
