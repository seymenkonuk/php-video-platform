<?php
// ============================================================================
// File:    HistoryRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Models\History;
use App\Domain\Models\HistoryDetails;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\IHistoryRepository;


/** @extends SqlRepository<History> */
class HistoryRepository extends SqlRepository implements IHistoryRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "history";
    protected string $primaryKey = "id";
    protected string $model = History::class;

    // --------------------------------------------------------------------------
    // HISTORY HEADER
    // --------------------------------------------------------------------------

    public function findDetailsByChannel(string $channelCode): ?HistoryDetails
    {
        return $this->database
            ->query("
                SELECT
                    COUNT(*) video_count,
                    SUM(v.duration) total_duration
                FROM history h
                INNER JOIN channel c
                    ON h.channel_id = c.id
                INNER JOIN video v
                    ON h.video_id = v.id
                WHERE c.code = :channelCode
                LIMIT 1
            ")
            ->execute(["channelCode" => $channelCode])
            ->fetch(HistoryDetails::class);
    }

    // --------------------------------------------------------------------------
    // HISTORY VIDEOS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM history h
                INNER JOIN channel c
                    ON h.channel_id = c.id
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
                FROM history h
                INNER JOIN channel c
                    ON h.channel_id = c.id
                INNER JOIN video v
                    ON h.video_id = v.id
                INNER JOIN channel vc
                    ON v.uploader_id = vc.id
                WHERE c.code = :channelCode
                ORDER BY h.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(VideoWithChannel::class);
    }
}
