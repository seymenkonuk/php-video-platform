<?php
// ============================================================================
// File:    ListItemViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Playlist;


use App\Support\DTOs\Playlist\ListItemDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class ListItemViewProp extends BaseViewProp
{
    public function __construct(
        public ListItemDTO $playlist,
    ) {}
}
