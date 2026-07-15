<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Video;


use App\Support\ViewModels\StudioViewModel;

use App\Support\DTOs\UI\OptionDTO;


class EditPageViewModel extends StudioViewModel
{
    public function __construct(
        public string $deleteUrl,
        /** @var array<OptionDTO> $viewTypes */
        public array $viewTypes,
        /** @var array<OptionDTO> $commentTypes */
        public array $commentTypes,
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
