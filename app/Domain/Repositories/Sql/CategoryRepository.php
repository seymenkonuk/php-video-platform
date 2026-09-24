<?php
// ============================================================================
// File:    CategoryRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\ViewType;
use App\Domain\Models\Category;
use App\Domain\Models\CategoryDetails;
use App\Domain\Models\CategoryWithStats;
use App\Domain\Repositories\Abstract\ICategoryRepository;


/** @extends SqlRepository<Category> */
class CategoryRepository extends SqlRepository implements ICategoryRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "category";
    protected string $primaryKey = "code";
    protected string $model = Category::class;

    // --------------------------------------------------------------------------
    // PUBLIC CATEGORIES
    // --------------------------------------------------------------------------

    public function countPublic(): int
    {
        // tüm kategoriler herkese açık olduğu için
        // tüm kategorilerin sayısını almak yeterli
        return $this->count();
    }

    public function yieldPublic(int $offset, int $limit): Generator
    {
        $publicViewType = ViewType::PUBLIC->value;
        return $this->database
            ->query("
                SELECT 
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM video_category vc
                        INNER JOIN video v
                            ON vc.video_id = v.id
                        WHERE vc.category_id = c.id
                          AND v.view_type = $publicViewType
                    ) as video_count
                FROM category c
                ORDER BY c.title ASC
                LIMIT $offset, $limit
            ")
            ->execute()
            ->cursor(CategoryWithStats::class);
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function findDetailsByCode(string $code): ?CategoryDetails
    {
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM video_category vc
                        WHERE vc.category_id = c.id
                    ) as video_count
                FROM category c
                WHERE c.code = :code
                LIMIT 1
            ")
            ->execute(["code" => $code])
            ->fetch(CategoryDetails::class);
    }
}
