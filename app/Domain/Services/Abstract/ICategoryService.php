<?php
// ============================================================================
// File:    ICategoryService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Http\Exception\NotFoundException;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Category\PageDTO;
use App\Support\DTOs\Category\PaginatedDTO;

use Config\PaginationConfig;


interface ICategoryService
{
    // --------------------------------------------------------------------------
    // CATEGORIES
    // --------------------------------------------------------------------------

    /**
     * Herkese açık kategorileri sayfalama bilgileriyle birlikte getirir.
     *
     * @param int $page sayfa numarası.
     * @param int $perPage sayfa başına gösterilecek kategori sayısı.
     * 
     * @throws NotFoundException $page bulunamazsa.
     *
     * @return PaginatedDTO
     */
    public function getCategories(
        int $page,
        int $perPage = PaginationConfig::CATEGORY_PER_PAGE,
    ): PaginatedDTO;

    /**
     * Kategori sayfasında kullanılacak verileri getirir.
     *
     * @param string $code kategori kodu.
     * @param ?AuthDTO $auth kategoriyi görüntüleyen kullanıcının kimliği.
     *
     * @throws NotFoundException $code veya $page bulunamazsa.
     *
     * @return PageDTO
     */
    public function getCategoryPage(
        string $code,
        int $page,
        int $perPage = PaginationConfig::CATEGORY_CONTENT_PER_PAGE,
        ?AuthDTO $auth = null,
    ): PageDTO;
}
