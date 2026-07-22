<?php
// ============================================================================
// File:    OfflineViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Layouts;


use App\Support\DTOs\UI\MenuItemDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class OfflineViewProp extends BaseViewProp
{
    /** @param array<string, array<MenuItemDTO>> $navMenus */
    public function __construct(
        public string $brandName,
        public string $title,
        public ?string $description,
        public array $navMenus,
        public string $dateYear,
    ) {}
}
