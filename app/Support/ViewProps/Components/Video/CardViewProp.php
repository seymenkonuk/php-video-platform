<?php
// ============================================================================
// File:    CardViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Video;


use App\Support\DTOs\Video\CardDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class CardViewProp extends BaseViewProp
{
    public function __construct(
        public CardDTO $video,
    ) {}
}
