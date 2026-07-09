<?php
// ============================================================================
// File:    LoginPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Auth;


use App\Support\ViewModels\BaseViewModel;


class LoginPageViewModel extends BaseViewModel
{
    public function __construct(
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
        public ?string $redirectUri,
    ) {}
}
