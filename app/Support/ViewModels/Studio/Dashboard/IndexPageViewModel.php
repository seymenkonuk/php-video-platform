<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Dashboard;


use App\Support\ViewModels\StudioViewModel;


class IndexPageViewModel extends StudioViewModel
{
    public function __construct(
        public string $editUrl,
        public string $changePasswordUrl,
        public string $deleteUrl,
    ) {
        parent::__construct();
    }
}
