<?php
// ============================================================================
// File:    HeroViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Components\Channel;


use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\UI\MenuItemDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class HeroViewProp extends BaseViewProp
{
    /** @param array<MenuItemDTO> $navItems */
    public function __construct(
        public HeaderDTO $header,
        public array $navItems,
        public ?string $activeNav = null,
    ) {}
}
