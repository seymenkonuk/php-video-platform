<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Channel;


use App\Support\ViewModels\BaseViewModel;


class EditPageViewModel extends BaseViewModel
{
    public function __construct(
        public string $deleteUrl,
        public string $changeActiveChannelUrl,
        public bool $isActive,
        /** @var array<mixed> $errorMessages */
        public array $errorMessages,
        /** @var array<mixed> $defaultValues */
        public array $defaultValues,
    ) {
        parent::__construct();
    }
}
