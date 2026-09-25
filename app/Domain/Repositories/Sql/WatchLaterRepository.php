<?php
// ============================================================================
// File:    WatchLaterRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Models\VideoWithChannel;
use App\Domain\Models\WatchLater;
use App\Domain\Models\WatchLaterDetails;
use App\Domain\Repositories\Abstract\IWatchLaterRepository;


/** @extends SqlRepository<WatchLater> */
class WatchLaterRepository extends SqlRepository implements IWatchLaterRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "watch_later";
    protected string $primaryKey = ".";
    protected string $model = WatchLater::class;

    // --------------------------------------------------------------------------
    // WATCH LATER HEADER
    // --------------------------------------------------------------------------

    public function findDetailsByChannel(string $channelCode): ?WatchLaterDetails
    {
        return $this->database
            ->query("
                SELECT
                    COUNT(*) video_count,
                    COALESCE(SUM(v.duration), 0) total_duration
                FROM watch_later wl
                INNER JOIN channel c
                    ON wl.channel_id = c.id
                INNER JOIN video v
                    ON wl.video_id = v.id
                WHERE c.code = :channelCode
            ")
            ->execute(["channelCode" => $channelCode])
            ->fetch(WatchLaterDetails::class);
    }

    // --------------------------------------------------------------------------
    // WATCH LATER VIDEOS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM watch_later wl
                INNER JOIN channel c
                    ON wl.channel_id = c.id
                WHERE c.code = :channelCode
            ")
            ->execute(["channelCode" => $channelCode])
            ->column();
        return $value;
    }

    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator
    {
        return $this->database
            ->query("
                SELECT
                    v.*,
                    vc.code channel_code,
                    vc.title channel_title,
                    vc.avatar_path channel_avatar
                FROM watch_later wl
                INNER JOIN channel c
                    ON wl.channel_id = c.id
                INNER JOIN video v
                    ON wl.video_id = v.id
                INNER JOIN channel vc
                    ON v.uploader_id = vc.id
                WHERE c.code = :channelCode
                ORDER BY wl.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(VideoWithChannel::class);
    }
}
