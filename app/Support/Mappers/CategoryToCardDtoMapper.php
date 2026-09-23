<?php
// ============================================================================
// File:    CategoryToCardDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Models\CategoryWithStats;

use App\Support\DTOs\Category\CardDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class CategoryToCardDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    public function map(CategoryWithStats $category): CardDTO
    {
        return new CardDTO(
            "/categories/{$category->code}",
            $category->title,
            $category->description,
            $category->banner_path ? "/uploads/categories/{$category->code}/banner" : DefaultImageConfig::DEFAULT_CATEGORY_BANNER,
            $category->video_count,
            $this->numberHelper->formatNumber($category->video_count),
        );
    }

    /**
     * @param Generator<int, CategoryWithStats> $categories
     * @return Generator<int, CardDTO>
     */
    public function mapMany(Generator $categories): Generator
    {
        foreach ($categories as $category) {
            yield $this->map($category);
        }
    }
}
