<?php
// ============================================================================
// File:    MenuItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\UI;


readonly class MenuItemDTO
{
    public function __construct(
        public string $href,
        public string $text,
        public string $icon,
    ) {}
}
