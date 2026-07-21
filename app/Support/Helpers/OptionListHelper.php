<?php
// ============================================================================
// File:    OptionListHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


use Config\ValidationConfig;

use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;

use App\Support\DTOs\UI\OptionDTO;


class OptionListHelper
{
    /**
     * Tüm ülke seçeneklerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public function getCountryOptions(): array
    {
        return array_map(
            fn($country) => new OptionDTO($country, $country),
            ValidationConfig::ALLOWED_COUNTRIES,
        );
    }

    /**
     * Tüm görüntüleme türlerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public function getViewTypeOptions(): array
    {
        return array_map(
            fn($viewType) => new OptionDTO((string)$viewType->value, $viewType->label()),
            ViewType::cases(),
        );
    }

    /**
     * Tüm yorum türlerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public function getCommentTypeOptions(): array
    {
        return array_map(
            fn($commentType) => new OptionDTO((string)$commentType->value, $commentType->label()),
            CommentType::cases(),
        );
    }
}
