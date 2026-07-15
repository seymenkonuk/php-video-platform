<?php
// ============================================================================
// File:    OptionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\UI;


readonly class OptionDTO
{
    public function __construct(
        public string $value,
        public string $title,
    ) {}
}
