<?php
// ============================================================================
// File:    AuthViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\ViewContexts\AuthViewContext;


abstract readonly class AuthViewModel extends BaseViewModel
{
    public function __construct(AuthViewContext $context)
    {
        parent::__construct($context->base);
    }
}
