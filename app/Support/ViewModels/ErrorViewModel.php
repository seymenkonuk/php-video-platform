<?php
// ============================================================================
// File:    ErrorViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


class ErrorViewModel extends BaseViewModel
{
    public function __construct(
        public string $layout,
        public ?string $title = null,
        public ?string $message = null,
    ) {
        parent::__construct();
    }
}
