<?php
// ============================================================================
// File:    CategoryContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\ViewType;
use App\Domain\Models\VideoCategory;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\ICategoryContentRepository;


/** @extends SqlRepository<VideoCategory> */
class CategoryContentRepository extends SqlRepository implements ICategoryContentRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "video_category";
    protected string $primaryKey = ".";
    protected string $model = VideoCategory::class;

    // --------------------------------------------------------------------------
    // CATEGORY VIDEOS
    // --------------------------------------------------------------------------

    public function countPublicByCategory(string $categoryCode): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM video_category vc
                INNER JOIN category c
                    ON vc.category_id = c.id
                INNER JOIN video v
                    ON vc.video_id = v.id
                WHERE v.view_type = $publicViewType
                  AND c.code = :categoryCode
            ")
            ->execute(["categoryCode" => $categoryCode])
            ->column();
        return $value;
    }

    public function yieldPublicByCategory(string $categoryCode, int $offset, int $limit): Generator
    {
        $publicViewType = ViewType::PUBLIC->value;
        return $this->database
            ->query("
                SELECT
                    v.*,
                    ch.code channel_code,
                    ch.title channel_title,
                    ch.avatar_path channel_avatar
                FROM video_category vc
                INNER JOIN category cat
                    ON vc.category_id = cat.id
                INNER JOIN video v
                    ON vc.video_id = v.id
                INNER JOIN channel ch
                    ON v.uploader_id = ch.id
                WHERE v.view_type = $publicViewType
                  AND cat.code = :categoryCode
                ORDER BY vc.created_at ASC
                LIMIT $offset, $limit
            ")
            ->execute(["categoryCode" => $categoryCode])
            ->cursor(VideoWithChannel::class);
    }
}
