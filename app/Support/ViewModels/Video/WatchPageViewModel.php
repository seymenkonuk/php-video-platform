<?php
// ============================================================================
// File:    WatchPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Video;


use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class WatchPageViewModel extends AppViewModel
{
    public function __construct(
        AppViewContext $context,
    ) {
        parent::__construct($context);
    }
}
