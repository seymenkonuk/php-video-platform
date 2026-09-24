<?php
// ============================================================================
// File:    PlaylistRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\ViewType;
use App\Domain\Models\Playlist;
use App\Domain\Models\PlaylistDetails;
use App\Domain\Models\PlaylistWithChannel;
use App\Domain\Repositories\Abstract\IPlaylistRepository;


/** @extends SqlRepository<Playlist> */
class PlaylistRepository extends SqlRepository implements IPlaylistRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "playlist";
    protected string $primaryKey = "code";
    protected string $model = Playlist::class;

    // --------------------------------------------------------------------------
    // PUBLIC PLAYLISTS
    // --------------------------------------------------------------------------

    public function countPublic(): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM playlist p
                WHERE p.view_type = $publicViewType
            ")
            ->execute()
            ->column();
        return $value;
    }

    public function yieldPublic(int $offset, int $limit): Generator
    {
        $publicViewType = ViewType::PUBLIC->value;
        return $this->database
            ->query("
                SELECT
                    p.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar,
                    (
                        SELECT COUNT(*)
                        FROM playlist_video pv
                        WHERE pv.playlist_id = p.id
                    ) as video_count
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
                WHERE p.view_type = $publicViewType
                ORDER BY p.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute()
            ->cursor(PlaylistWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // CHANNEL PLAYLISTS
    // --------------------------------------------------------------------------

    public function countPublicByChannel(string $channelCode): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
                WHERE p.view_type = $publicViewType
                  AND c.code = :channelCode
            ")
            ->execute(["channelCode" => $channelCode])
            ->column();
        return $value;
    }

    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator
    {
        $publicViewType = ViewType::PUBLIC->value;
        return $this->database
            ->query("
                SELECT
                    p.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar,
                    (
                        SELECT COUNT(*)
                        FROM playlist_video pv
                        WHERE pv.playlist_id = p.id
                    ) as video_count
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
                WHERE p.view_type = $publicViewType
                  AND c.code = :channelCode
                ORDER BY p.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(PlaylistWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // STUDIO PLAYLISTS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
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
                    p.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar,
                    (
                        SELECT COUNT(*)
                        FROM playlist_video pv
                        WHERE pv.playlist_id = p.id
                    ) as video_count
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
                WHERE c.code = :channelCode
                ORDER BY p.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(PlaylistWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function findByCode(string $code): ?Playlist
    {
        return $this->find($code);
    }

    public function findDetailsByCode(string $code): ?PlaylistDetails
    {
        return $this->database
            ->query("
                SELECT
                    p.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar,
                    (
                        SELECT COUNT(*)
                        FROM playlist_video pv
                        WHERE pv.playlist_id = p.id
                    ) as video_count,
                    (
                        SELECT SUM(v.duration)
                        FROM playlist_video pv
                        LEFT JOIN video v
                            ON v.id = pv.video_id
                        WHERE pv.playlist_id = p.id
                    ) as total_duration
                FROM playlist p
                INNER JOIN channel c
                    ON p.channel_id = c.id
                WHERE p.code = :code
                LIMIT 1
            ")
            ->execute(["code" => $code])
            ->fetch(PlaylistDetails::class);
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $playlist): string|false
    {
        return parent::create($playlist);
    }

    public function update(int|string $code, array $playlist): bool
    {
        return parent::update($code, $playlist);
    }

    public function delete(int|string $code): bool
    {
        return parent::delete($code);
    }
}
