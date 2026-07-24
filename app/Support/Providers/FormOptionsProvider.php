<?php
// ============================================================================
// File:    FormOptionsProvider.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Providers;


use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;

use App\Support\DTOs\UI\OptionDTO;

use Config\ValidationConfig;


final class FormOptionsProvider
{
    /** @return array<OptionDTO> */
    public function createCountries(): array
    {
        return array_map(
            fn($country) => new OptionDTO($country, $country),
            ValidationConfig::ALLOWED_COUNTRIES,
        );
    }

    /** @return array<OptionDTO> */
    public function viewTypes(): array
    {
        return array_map(
            fn($viewType) => new OptionDTO((string)$viewType->value, $viewType->label()),
            ViewType::cases(),
        );
    }

    /** @return array<OptionDTO> */
    public function commentTypes(): array
    {
        return array_map(
            fn($commentType) => new OptionDTO((string)$commentType->value, $commentType->label()),
            CommentType::cases(),
        );
    }

    /**
     * @return array{
     *     viewTypes: array<OptionDTO>,
     *     commentTypes: array<OptionDTO>
     * }
     */
    public function media(): array
    {
        return [
            "viewTypes" => $this->viewTypes(),
            "commentTypes" => $this->commentTypes(),
        ];
    }

    /**
     * @return array{
     *     viewTypes: array<OptionDTO>
     * }
     */
    public function playlist(): array
    {
        return [
            "viewTypes" => $this->viewTypes(),
        ];
    }

    /**
     * @return array{
     *     countries: array<OptionDTO>
     * }
     */
    public function countries(): array
    {
        return [
            "countries" => $this->createCountries(),
        ];
    }
}
