<?php
// ============================================================================
// File:    TextLinkViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\ViewProps\BaseViewProp;


final readonly class TextLinkViewProp extends BaseViewProp
{
    public function __construct(
        public ?string $leftText,
        public string $href,
        public string $link,
        public ?string $rightText,
    ) {}
}
