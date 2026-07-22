<?php
// ============================================================================
// File:    CreateViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps\Forms\Short;


use App\Support\DTOs\UI\OptionDTO;

use App\Support\ViewProps\BaseViewProp;


final readonly class CreateViewProp extends BaseViewProp
{
    /**
     * @param array{
     *      body?: array<string, mixed>,
     *      query?: array<string, mixed>,
     *      params?: array<string, mixed>,
     *      body?: array<string, mixed>,
     * } $errorMessages
     * @param array{
     *      body?: array<string, mixed>,
     *      query?: array<string, mixed>,
     *      params?: array<string, mixed>,
     *      body?: array<string, mixed>,
     * } $defaultValues
     * @param array<OptionDTO> $viewTypes
     * @param array<OptionDTO> $commentTypes
     */
    public function __construct(
        public array $errorMessages,
        public array $defaultValues,
        public array $viewTypes,
        public array $commentTypes,
    ) {}
}
