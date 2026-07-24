<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Search;


use App\Support\ViewContexts\AppViewContext;
use App\Support\ViewModels\AppViewModel;


final readonly class IndexPageViewModel extends AppViewModel
{
    public function __construct(
        AppViewContext $context,
        public string $search,
    ) {
        parent::__construct($context);
    }
}
