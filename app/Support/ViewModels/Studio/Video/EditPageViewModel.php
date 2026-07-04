<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Video;


use App\Support\DTOs\OptionDTO;


class EditPageViewModel
{
    public function __construct(
        public string $deleteUrl,
        /** @var array<OptionDTO> $viewTypes */
        public array $viewTypes,
        /** @var array<OptionDTO> $commentTypes */
        public array $commentTypes,
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
    ) {}
}
