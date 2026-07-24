<?php
// ============================================================================
// File:    StudioViewContext.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewContexts;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\UI\MenuItemDTO;


final readonly class StudioViewContext
{
    /** @param array<string, array<MenuItemDTO>> $navMenus */
    public function __construct(
        public BaseViewContext $base,
        public array $navMenus,
        public ?AuthDTO $auth,
    ) {}
}
