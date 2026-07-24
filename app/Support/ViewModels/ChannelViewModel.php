<?php
// ============================================================================
// File:    ChannelViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\UI\MenuItemDTO;
use App\Support\DTOs\Channel\HeaderDTO;

use App\Support\ViewContexts\ChannelViewContext;


abstract readonly class ChannelViewModel extends AppViewModel
{
    /** @var array<MenuItemDTO> $navItems */
    public array $navItems;
    public HeaderDTO $header;

    public function __construct(ChannelViewContext $context)
    {
        parent::__construct($context->app);

        $this->header = $context->header;
        $this->navItems = $context->navItems;
    }
}
