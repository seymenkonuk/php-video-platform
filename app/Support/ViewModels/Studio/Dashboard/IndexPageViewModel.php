<?php
// ============================================================================
// File:    IndexPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Dashboard;


class IndexPageViewModel
{
    public function __construct(
        public string $editUrl,
        public string $changePasswordUrl,
        public string $deleteUrl,
    ) {}
}
