<?php
// ============================================================================
// File:    CheckboxViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Interaction;


use App\Support\ViewProps\BaseViewProp;


final readonly class CheckboxViewProp extends BaseViewProp
{
    public function __construct(
        public string $url,
        public ?string $data,
        public string $title,
        public string $class,
        public string $inputClass,
        public bool $checked = false,
        public bool $disabled = false,
        public int $parentDepth = 0,
    ) {}
}
