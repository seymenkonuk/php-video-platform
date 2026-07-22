<?php
// ============================================================================
// File:    TextInputViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\ViewProps\BaseViewProp;


final readonly class TextInputViewProp extends BaseViewProp
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
        public ?string $autocomplete = null,
        public ?string $min = null,
        public ?string $max = null,
        public ?string $step = null,
        public bool $required = false,
        public bool $disabled = false,
    ) {}
}
