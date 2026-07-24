<?php
// ============================================================================
// File:    EditPageViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels\Studio\Channel;


use App\Support\ViewContexts\StudioViewContext;
use App\Support\ViewModels\StudioViewModel;


final readonly class EditPageViewModel extends StudioViewModel
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
        public string $channelCode,
        public string $deleteUrl,
        public string $changeActiveChannelUrl,
        public bool $isActive,
        public array $errorMessages,
        public array $defaultValues,
    ) {
        parent::__construct($context);
    }
}
