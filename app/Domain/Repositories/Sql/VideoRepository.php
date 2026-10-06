<?php
// ============================================================================
// File:    VideoRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\LikeType;
use App\Domain\Enums\VideoType;
use App\Domain\Enums\ViewType;
use App\Domain\Models\Video;
use App\Domain\Models\VideoDetails;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\IVideoRepository;

use Config\ValidationConfig;


/** @extends SqlRepository<Video> */
class VideoRepository extends SqlRepository implements IVideoRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "video";
    protected string $primaryKey = "code";
    protected string $model = Video::class;

    protected int $type = VideoType::VIDEO->value;

    // --------------------------------------------------------------------------
    // PUBLIC VIDEOS
    // --------------------------------------------------------------------------

    public function countPublic(): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM video v
                WHERE v.video_type = {$this->type}
                  AND v.view_type = $publicViewType
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
                    v.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND v.view_type = $publicViewType
                ORDER BY v.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute()
            ->cursor(VideoWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // CHANNEL VIDEOS
    // --------------------------------------------------------------------------

    public function countPublicByChannel(string $channelCode): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND v.view_type = $publicViewType
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
                    v.*,
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND v.view_type = $publicViewType
                  AND c.code = :channelCode
                ORDER BY v.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(VideoWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // STUDIO VIDEOS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND c.code = :channelCode
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
                    c.code channel_code,
                    c.title channel_title,
                    c.avatar_path channel_avatar
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND c.code = :channelCode
                ORDER BY v.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["channelCode" => $channelCode])
            ->cursor(VideoWithChannel::class);
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function findByCode(string $code): ?Video
    {
        return $this->database
            ->query("
                SELECT *
                FROM video v
                WHERE v.video_type = {$this->type}
                  AND v.code = :code
                LIMIT 1
            ")
            ->execute(["code" => $code])
            ->fetch(Video::class);
    }

    public function findDetailsByCode(string $code, ?string $channelCode): ?VideoDetails
    {
        $isGuest = (!$channelCode) ? "TRUE" : "FALSE";
        $likeType = LikeType::LIKE->value;
        $dislikeType = LikeType::DISLIKE->value;
        return $this->database
            ->query("
                SELECT
                    v.*,
                    c.code as channel_code,
                    c.title as channel_title,
                    c.avatar_path as channel_avatar,
                    (
                        SELECT COUNT(*)
                        FROM liked l
                        WHERE l.video_id = v.id
                          AND l.type = $likeType
                    ) as like_count,
                    (
                        SELECT COUNT(*)
                        FROM liked l
                        WHERE l.video_id = v.id
                          AND l.type = $dislikeType
                    ) as dislike_count,
                    CASE
                        WHEN $isGuest THEN FALSE
                        ELSE COALESCE(
                            (
                                SELECT TRUE
                                FROM liked l
                                INNER JOIN channel ch
                                    ON l.channel_id = ch.id
                                WHERE l.video_id = v.id
                                  AND l.type = $likeType
                                  AND ch.code = :channelCode1
                                LIMIT 1
                            ),
                            FALSE
                        )
                    END AS liked,
                    CASE
                        WHEN $isGuest THEN FALSE
                        ELSE COALESCE(
                            (
                                SELECT TRUE
                                FROM liked l
                                INNER JOIN channel ch
                                    ON l.channel_id = ch.id
                                WHERE l.video_id = v.id
                                  AND l.type = $dislikeType
                                  AND ch.code = :channelCode2
                                LIMIT 1
                            ),
                            FALSE
                        )
                    END AS disliked,
                    CASE
                        WHEN $isGuest THEN FALSE
                        ELSE COALESCE(
                            (
                                SELECT TRUE
                                FROM watch_later wl
                                INNER JOIN channel ch
                                    ON wl.channel_id = ch.id
                                WHERE wl.video_id = v.id
                                  AND ch.code = :channelCode3
                                LIMIT 1
                            ),
                            FALSE
                        )
                    END AS in_watch_later
                FROM video v
                INNER JOIN channel c
                    ON v.uploader_id = c.id
                WHERE v.video_type = {$this->type}
                  AND v.code = :code
                LIMIT 1
            ")
            ->execute([
                "code" => $code,
                "channelCode1" => $channelCode,
                "channelCode2" => $channelCode,
                "channelCode3" => $channelCode,
            ])
            ->fetch(VideoDetails::class);
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $video): string|false
    {
        $video["code"] = $this->generateUniqueCode(ValidationConfig::CODE_MIN_LEN);
        $video["video_type"] = $this->type;
        return parent::create($video);
    }

    public function update(int|string $code, array $video): bool
    {
        // Bu koda sahip video yok! (belki müzik veya kısa video olabilir)
        if (!$this->findByCode((string)$code)) {
            return false;
        }
        // Yukarıdaki kontrol yanlışlıkla istenen türdeki içerik yerine başka içeriğin değiştirilmesini engelliyor1
        // Örneğin $this->videoRepository->update("example-code", ...) müzik içeriğini güncelleyebilir.
        return parent::update($code, $video);
    }

    public function delete(int|string $code): bool
    {
        // Bu koda sahip video yok! (belki müzik veya kısa video olabilir)
        if (!$this->findByCode((string)$code)) {
            return false;
        }
        // Yukarıdaki kontrol yanlışlıkla istenen türdeki içerik yerine başka içeriğin silinmesini engelliyor1
        // Örneğin $this->videoRepository->delete("example-code") kısa video içeriğini silebilir.
        return parent::delete($code);
    }
}
