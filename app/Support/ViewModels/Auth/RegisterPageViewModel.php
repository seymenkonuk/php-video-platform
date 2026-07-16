<?php
// ============================================================================
// File:    RegisterPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Auth;


use App\Support\ViewModels\AuthViewModel;

use App\Support\DTOs\UI\OptionDTO;

use App\Support\Helpers\OptionListHelper;


class RegisterPageViewModel extends AuthViewModel
{
    /** @var array<OptionDTO> $countries */
    public array $countries;

    public function __construct(
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $errorMessages */
        public array $errorMessages,
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $defaultValues */
        public array $defaultValues,
        public ?string $redirectUri = null,
    ) {
        parent::__construct();
        $this->countries = OptionListHelper::getCountryOptions();
    }
}
