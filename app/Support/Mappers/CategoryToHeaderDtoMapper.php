<?php
// ============================================================================
// File:    CategoryToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\CategoryDetails;

use App\Support\DTOs\Category\HeaderDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class CategoryToHeaderDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    public function map(CategoryDetails $category): HeaderDTO
    {
        return new HeaderDTO(
            $category->title,
            $category->description,
            $category->banner_path ? "/uploads/categories/{$category->code}/banner" : DefaultImageConfig::DEFAULT_CATEGORY_BANNER,
            $category->video_count,
            $this->numberHelper->formatNumber($category->video_count),
        );
    }
}
