<?php
// ============================================================================
// File:    AddToPlaylistViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Interaction;


use Generator;

use App\Support\DTOs\Playlist\OptionDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class AddToPlaylistViewProp extends BaseViewProp
{
    /** @param Generator<int, OptionDTO> $playlists */
    public function __construct(
        public ?string $addData,
        public Generator $playlists,
    ) {}
}
