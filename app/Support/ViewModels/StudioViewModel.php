<?php
// ============================================================================
// File:    StudioViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\UI\MenuItemDTO;

use App\Support\ViewContexts\StudioViewContext;


abstract readonly class StudioViewModel extends BaseViewModel
{
    /** @var array<string, array<MenuItemDTO>> $navMenus */
    public array $navMenus;
    public ?AuthDTO $auth;

    public function __construct(StudioViewContext $context)
    {
        parent::__construct($context->base);

        $this->navMenus = $context->navMenus;
        $this->auth = $context->auth;
    }
}
