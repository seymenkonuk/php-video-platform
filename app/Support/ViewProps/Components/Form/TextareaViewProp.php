<?php
// ============================================================================
// File:    TextareaViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\ViewProps\BaseViewProp;


final readonly class TextareaViewProp extends BaseViewProp
{
    /** @param ?array<string> $errors */
    public function __construct(
        public string $name,
        public ?string $label,
        public ?string $icon,
        public string $placeholder,
        public ?string $description,
        public ?array $errors,
        public string $value,
        public int $rows = 1,
        public bool $required = false,
        public bool $disabled = false,
    ) {}
}
