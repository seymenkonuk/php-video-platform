<?php
// ============================================================================
// File:    LikedRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\LikeType;
use App\Domain\Models\Liked;
use App\Domain\Models\LikedDetails;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\ILikedRepository;


/** @extends SqlRepository<Liked> */
class LikedRepository extends SqlRepository implements ILikedRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "liked";
    protected string $primaryKey = ".";
    protected string $model = Liked::class;

    // --------------------------------------------------------------------------
    // LIKED HEADER
    // --------------------------------------------------------------------------

    public function findDetailsByChannel(string $channelCode): ?LikedDetails
    {
        $likeType = LikeType::LIKE->value;
        return $this->database
            ->query("
                SELECT
                    COUNT(*) video_count,
                    SUM(v.duration) total_duration
                FROM liked l
                INNER JOIN channel c
                    ON l.channel_id = c.id
                INNER JOIN video v
                    ON l.video_id = v.id
                WHERE l.type = $likeType
                  AND c.code = :channelCode
                LIMIT 1
            ")
            ->execute(["channelCode" => $channelCode])
            ->fetch(LikedDetails::class);
    }

    // --------------------------------------------------------------------------
    // LIKED VIDEOS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        $likeType = LikeType::LIKE->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM liked l
                INNER JOIN channel c
                    ON l.channel_id = c.id
                WHERE l.type = $likeType
                  AND c.code = :channelCode
            ")
            ->execute(["channelCode" => $channelCode])
            ->column();
        return $value;
    }

    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator
    {
        $likeType = LikeType::LIKE->value;
        return $this->database
            ->query("
                SELECT
                    v.*,
                    vc.code channel_code,
                    vc.title channel_title,
                    vc.avatar_path channel_avatar
                FROM liked l
                INNER JOIN channel c
                    ON l.channel_id = c.id
                INNER JOIN video v
                    ON l.video_id = v.id
                INNER JOIN channel vc
                    ON v.uploader_id = vc.id
                WHERE l.type = $likeType
                  AND c.code = :channelCode
                ORDER BY l.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(VideoWithChannel::class);
    }
}
