<?php
// ============================================================================
// File:    ErrorViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


class ErrorViewModel
{
    /** @param array<mixed> $layoutData */
    public function __construct(
        public string $layout,
        public array $layoutData,
        public ?string $title = null,
        public ?string $description = null,
    ) {}
}
