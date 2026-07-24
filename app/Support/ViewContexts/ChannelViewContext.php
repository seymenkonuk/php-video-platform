<?php
// ============================================================================
// File:    ChannelViewContext.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewContexts;


use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\UI\MenuItemDTO;


final readonly class ChannelViewContext
{
    /** @param array<MenuItemDTO> $navItems */
    public function __construct(
        public AppViewContext $app,
        public HeaderDTO $header,
        public array $navItems,
    ) {}
}
