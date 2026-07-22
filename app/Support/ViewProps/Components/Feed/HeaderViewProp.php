<?php
// ============================================================================
// File:    HeaderViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Feed;


use App\Support\DTOs\Library\LibraryHeaderDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class HeaderViewProp extends BaseViewProp
{
    public function __construct(
        public string $icon,
        public string $eyebrow,
        public string $title,
        public LibraryHeaderDTO $header,
    ) {}
}
