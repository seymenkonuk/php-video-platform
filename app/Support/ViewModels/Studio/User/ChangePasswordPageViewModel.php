<?php
// ============================================================================
// File:    ChangePasswordPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\User;


use App\Support\ViewModels\StudioViewModel;


class ChangePasswordPageViewModel extends StudioViewModel
{
    public function __construct(
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
    ) {
        parent::__construct();
    }
}
