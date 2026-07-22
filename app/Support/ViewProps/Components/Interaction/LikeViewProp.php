<?php
// ============================================================================
// File:    LikeViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Interaction;


use App\Support\ViewProps\BaseViewProp;


final readonly class LikeViewProp extends BaseViewProp
{
    public function __construct(
        public string $url,
        public bool $liked,
        public int $likeCount,
        public string $likeCountFormatted,
        public int $parentDepth = 0,
    ) {}
}
