<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\User;


use App\Support\DTOs\UI\OptionDTO;

use App\Support\ViewContexts\StudioViewContext;
use App\Support\ViewModels\StudioViewModel;


final readonly class EditPageViewModel extends StudioViewModel
{
    /** @var array<OptionDTO> $countries */
    public array $countries;

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
     * @param array{
     *     countries: array<OptionDTO>,
     * } $options
     */
    public function __construct(
        StudioViewContext $context,
        array $options,
        public string $deleteUrl,
        public array $errorMessages,
        public array $defaultValues,
    ) {
        parent::__construct($context);

        $this->countries = $options["countries"];
    }
}
