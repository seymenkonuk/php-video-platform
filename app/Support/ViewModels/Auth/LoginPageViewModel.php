<?php
// ============================================================================
// File:    LoginPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Auth;


use App\Support\ViewContexts\AuthViewContext;
use App\Support\ViewModels\AuthViewModel;


final readonly class LoginPageViewModel extends AuthViewModel
{
    /**
     * @param array{
     *     body?: array<string, mixed>,
     *     query?: array<string, mixed>,
     *     params?: array<string, mixed>,
     *     files?: array<string, mixed>,
     * } $errorMessages
     * @param array{
     *     body?: array<string, mixed>,
     *     query?: array<string, mixed>,
     *     params?: array<string, mixed>,
     *     files?: array<string, mixed>,
     * } $defaultValues
     */
    public function __construct(
        AuthViewContext $context,
        public string $loginUri,
        public string $registerUri,
        public array $errorMessages,
        public array $defaultValues,
    ) {
        parent::__construct($context);
    }
}
