<?php
// ============================================================================
// File:    CreatePageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Short;


use App\Support\ViewModels\StudioViewModel;

use App\Support\DTOs\UI\OptionDTO;

use App\Support\Helpers\OptionListHelper;


class CreatePageViewModel extends StudioViewModel
{
    /** @var array<OptionDTO> $viewTypes */
    public array $viewTypes;
    /** @var array<OptionDTO> $commentTypes */
    public array $commentTypes;

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
        $optionListHelper = new OptionListHelper();
        $this->viewTypes = $optionListHelper->getViewTypeOptions();
        $this->commentTypes = $optionListHelper->getCommentTypeOptions();
    }
}
