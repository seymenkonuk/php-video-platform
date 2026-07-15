<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\User;


use App\Support\ViewModels\StudioViewModel;

use App\Support\DTOs\UI\OptionDTO;


class EditPageViewModel extends StudioViewModel
{
    public function __construct(
        public string $deleteUrl,
        /** @var array<OptionDTO> $countries */
        public array $countries,
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
    ) {
        parent::__construct();
    }
}
