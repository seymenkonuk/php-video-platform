<?php
// ============================================================================
// File:    SidebarViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Partials;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\UI\MenuItemDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class SidebarViewProp extends BaseViewProp
{
    /** @param array<string, array<MenuItemDTO>> $navMenus */
    public function __construct(
        public string $brandName,
        public ?string $activeNav,
        public array $navMenus,
        public ?AuthDTO $auth,
    ) {}
}
