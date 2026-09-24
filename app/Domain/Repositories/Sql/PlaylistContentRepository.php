<?php
// ============================================================================
// File:    PlaylistContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Models\PlaylistVideo;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\IPlaylistContentRepository;


/** @extends SqlRepository<PlaylistVideo> */
class PlaylistContentRepository extends SqlRepository implements IPlaylistContentRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "playlist_video";
    protected string $primaryKey = ".";
    protected string $model = PlaylistVideo::class;

    // --------------------------------------------------------------------------
    // PLAYLIST VIDEOS
    // --------------------------------------------------------------------------

    public function countByPlaylist(string $playlistCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM playlist_video pv
                INNER JOIN playlist p
                    ON pv.playlist_id = p.id
                WHERE p.code = :playlistCode
            ")
            ->execute(["playlistCode" => $playlistCode])
            ->column();
        return $value;
    }

    public function yieldByPlaylist(string $playlistCode, int $offset, int $limit): Generator
    {
        return $this->database
            ->query("
                SELECT
                    v.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar
                FROM playlist_video pv
                INNER JOIN playlist p
                    ON pv.playlist_id = p.id
                INNER JOIN video v
                    ON pv.video_id = v.id
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE p.code = :playlistCode
                ORDER BY pv.position ASC
                LIMIT $offset, $limit
            ")
            ->execute(["playlistCode" => $playlistCode])
            ->cursor(VideoWithChannel::class);
    }
}
