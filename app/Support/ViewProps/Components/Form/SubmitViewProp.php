<?php
// ============================================================================
// File:    SubmitViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\ViewProps\BaseViewProp;


final readonly class SubmitViewProp extends BaseViewProp
{
    public function __construct(
        public ?string $id,
        public ?string $icon,
        public string $text,
        public string $color,
        public string $hoverColor,
        public string $textColor,
        public bool $fullWidth = true,
        public bool $disabled = false,
    ) {}
}
