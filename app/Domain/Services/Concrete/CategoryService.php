<?php
// ============================================================================
// File:    CategoryService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use App\Domain\Repositories\Abstract\ICategoryRepository;
use App\Domain\Services\Abstract\ICategoryService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Category\PageDTO;
use App\Support\DTOs\Category\PaginatedDTO;

use Config\PaginationConfig;


class CategoryService implements ICategoryService
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ICategoryRepository $categoryRepository,
    ) {}

    // --------------------------------------------------------------------------
    // CATEGORIES
    // --------------------------------------------------------------------------

    public function getCategories(
        int $page,
        int $perPage = PaginationConfig::CATEGORY_PER_PAGE,
    ): PaginatedDTO {
        throw new \Exception('Not implemented');
    }

    public function getCategoryPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CATEGORY_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO {
        throw new \Exception('Not implemented');
    }
}
