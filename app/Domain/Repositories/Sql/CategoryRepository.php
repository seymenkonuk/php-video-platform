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

use App\Domain\Models\Category;
use App\Domain\Models\CategoryDetails;
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
        return $this->count();
    }

    public function yieldPublic(int $offset, int $limit): Generator
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function findDetailsByCode(string $code): ?CategoryDetails
    {
        throw new \Exception('Not implemented');
    }
}
