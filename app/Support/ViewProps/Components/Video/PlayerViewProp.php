<?php
// ============================================================================
// File:    PlayerViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Video;


use App\Support\ViewProps\BaseViewProp;


final readonly class PlayerViewProp extends BaseViewProp
{
    public function __construct(
        public string $poster,
        public string $source,
        public int $startTime = 0,
        public ?string $nextUrl = null,
    ) {}
}
