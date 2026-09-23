<?php
// ============================================================================
// File:    CategoryService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Exception\NotFound\CategoryNotFoundException;
use App\Domain\Exception\Private\PrivateCategoryException;
use App\Domain\Policies\CategoryPolicy;
use App\Domain\Repositories\Abstract\ICategoryRepository;
use App\Domain\Repositories\Abstract\ICategoryContentRepository;
use App\Domain\Services\Abstract\ICategoryService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Category\PageDTO;
use App\Support\DTOs\Category\PaginatedDTO;
use App\Support\Helpers\PaginationHelper;
use App\Support\Mappers\CategoryToCardDtoMapper;
use App\Support\Mappers\CategoryToHeaderDtoMapper;
use App\Support\Mappers\VideoToListItemDtoMapper;

use Config\PaginationConfig;


class CategoryService implements ICategoryService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ICategoryRepository $categoryRepository,
        protected ICategoryContentRepository $categoryContentRepository,
        protected CategoryToCardDtoMapper $categoryCardMapper,
        protected CategoryToHeaderDtoMapper $categoryHeaderMapper,
        protected VideoToListItemDtoMapper $videoListItemMapper,
    ) {}

    // --------------------------------------------------------------------------
    // CATEGORIES
    // --------------------------------------------------------------------------

    public function getCategories(
        int $page,
        int $perPage = PaginationConfig::CATEGORY_PER_PAGE,
    ): PaginatedDTO {
        // Public Kategorileri Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->categoryRepository->countPublic(),
            $perPage,
            fn($offset, $limit) => $this->categoryRepository->yieldPublic($offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PaginatedDTO(
            categories: $this->categoryCardMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }

    public function getCategoryPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CATEGORY_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO {
        // Kategori Detaylarını Al
        $details = $this->categoryRepository->findDetailsByCode($code);

        // Kategori Bulunamadı
        if (!$details) {
            throw new CategoryNotFoundException();
        }

        // Kategori Görüntüleme Yetkisi Yok
        if (!CategoryPolicy::canView($auth, $details)) {
            throw new PrivateCategoryException();
        }

        // Kategori Videolarını Sayfalama Yaparak Al
        $paginated = PaginationHelper::create(
            $page,
            $this->categoryContentRepository->countPublicByCategory($code),
            $perPage,
            fn($offset, $limit) => $this->categoryContentRepository->yieldPublicByCategory($code, $offset, $limit),
        );

        // DTO'ya Dönüştür
        return new PageDTO(
            header: $this->categoryHeaderMapper->map($details),
            videos: $this->videoListItemMapper->mapMany($paginated["data"]),
            pagination: $paginated["pagination"],
        );
    }
}
