<?php
// ============================================================================
// File:    CreatePageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Channel;


use App\Support\ViewModels\StudioViewModel;


class CreatePageViewModel extends StudioViewModel
{
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
    ) {
        parent::__construct();
    }
}
