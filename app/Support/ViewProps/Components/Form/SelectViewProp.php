<?php
// ============================================================================
// File:    SelectViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Form;


use App\Support\DTOs\UI\OptionDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class SelectViewProp extends BaseViewProp
{
    /**
     * @param ?array<string> $errors
     * @param array<OptionDTO> $options
     */
    public function __construct(
        public string $name,
        public ?string $label,
        public ?string $icon,
        public ?string $description,
        public ?array $errors,
        public string $value,
        public ?OptionDTO $default,
        public array $options = [],
        public bool $required = false,
        public bool $disabled = false,
    ) {}
}
