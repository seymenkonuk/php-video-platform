<?php
// ============================================================================
// File:    BaseViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\ViewContexts\BaseViewContext;


abstract readonly class BaseViewModel
{
    public string $brandName;
    public string $csrfToken;
    public string $dateYear;

    public function __construct(BaseViewContext $context)
    {
        $this->brandName = $context->brandName;
        $this->csrfToken = $context->csrfToken;
        $this->dateYear = $context->dateYear;
    }
}
