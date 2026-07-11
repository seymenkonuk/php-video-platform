<?php
// ============================================================================
// File:    CreatePageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Video;


use App\Support\ViewModels\BaseViewModel;

use App\Support\DTOs\OptionDTO;


class CreatePageViewModel extends BaseViewModel
{
    public function __construct(
        /** @var array<OptionDTO> $viewTypes */
        public array $viewTypes,
        /** @var array<OptionDTO> $commentTypes */
        public array $commentTypes,
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
    ) {
        parent::__construct();
    }
}
