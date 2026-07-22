<?php
// ============================================================================
// File:    CheckboxViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\ViewProps\BaseViewProp;


final readonly class CheckboxViewProp extends BaseViewProp
{
    /** @param ?array<string> $errors */
    public function __construct(
        public string $name,
        public ?string $label,
        public ?string $icon,
        public string $text,
        public ?string $description,
        public ?array $errors,
        public string $value,
        public bool $checked,
        public bool $required = false,
        public bool $disabled = false,
    ) {}
}
