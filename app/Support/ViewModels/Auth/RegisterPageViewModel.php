<?php
// ============================================================================
// File:    RegisterPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Auth;


use App\Support\DTOs\UI\OptionDTO;
use App\Support\ViewModels\AuthViewModel;


class RegisterPageViewModel extends AuthViewModel
{
    public function __construct(
        /** @var array<OptionDTO> $countries */
        public array $countries,
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
        public ?string $redirectUri = null,
    ) {
        parent::__construct();
    }
}
