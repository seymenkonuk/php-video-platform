<?php
// ============================================================================
// File:    PlaylistCheckboxViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Interaction;


use App\Support\DTOs\Playlist\OptionDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class PlaylistCheckboxViewProp extends BaseViewProp
{
    public function __construct(
        public string $url,
        public ?string $data,
        public OptionDTO $playlist,
    ) {}
}
