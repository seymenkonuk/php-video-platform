<?php
// ============================================================================
// File:    ChangePasswordPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\User;


use App\Support\ViewContexts\StudioViewContext;
use App\Support\ViewModels\StudioViewModel;


final readonly class ChangePasswordPageViewModel extends StudioViewModel
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
        StudioViewContext $context,
        public array $errorMessages,
        public array $defaultValues,
    ) {
        parent::__construct($context);
    }
}
