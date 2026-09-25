<?php
// ============================================================================
// File:    ChannelRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\SubscribeType;
use App\Domain\Models\Channel;
use App\Domain\Models\ChannelDetails;
use App\Domain\Models\ChannelWithStats;
use App\Domain\Repositories\Abstract\IChannelRepository;


/** @extends SqlRepository<Channel> */
class ChannelRepository extends SqlRepository implements IChannelRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "channel";
    protected string $primaryKey = "code";
    protected string $model = Channel::class;

    // --------------------------------------------------------------------------
    // PUBLIC CHANNELS
    // --------------------------------------------------------------------------

    public function countPublic(): int
    {
        // tüm kanallar herkese açık olduğu için
        // tüm kanalların sayısını almak yeterli
        return $this->count();
    }

    public function yieldPublic(int $offset, int $limit, ?string $channelCode): Generator
    {
        $isGuest = (!$channelCode) ? "TRUE" : "FALSE";
        $guestSubscribeType = SubscribeType::GUEST_SUBSCRIBE_NOT_ALLOWED->value;
        $selfSubscribeType = SubscribeType::SELF_SUBSCRIBE_NOT_ALLOWED->value;
        $notSubscribeType = SubscribeType::NOT_SUBSCRIBED->value;
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM subscription s
                        WHERE s.subscribed_id = c.id
                    ) as subscriber_count,
                    (
                        SELECT COUNT(*)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as video_count,
                    (
                        SELECT COALESCE(SUM(v.view_count), 0)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as view_count,
                    CASE
                        WHEN $isGuest THEN $guestSubscribeType
                        WHEN c.code = :channelCode1 THEN $selfSubscribeType
                        ELSE COALESCE(
                            (
                                SELECT s.type
                                FROM subscription s
                                INNER JOIN channel ch
                                    ON s.subscriber_id = ch.id
                                WHERE s.subscribed_id = c.id
                                AND ch.code = :channelCode2
                                LIMIT 1
                            ),
                            $notSubscribeType
                        )
                    END AS subscribe_type,
                    CASE
                        WHEN $isGuest THEN NULL
                        WHEN c.code = :channelCode3 THEN NULL
                        ELSE (
                            SELECT s.subscribe_title
                            FROM subscription s
                            INNER JOIN channel ch
                                ON s.subscriber_id = ch.id
                            WHERE s.subscribed_id = c.id
                              AND ch.code = :channelCode4
                            LIMIT 1
                        )
                    END AS subscribe_title
                FROM channel c
                ORDER BY c.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute([
                "channelCode1" => $channelCode,
                "channelCode2" => $channelCode,
                "channelCode3" => $channelCode,
                "channelCode4" => $channelCode,
            ])
            ->cursor(ChannelDetails::class);
    }

    // --------------------------------------------------------------------------
    // SUBSCRIBED CHANNELS
    // --------------------------------------------------------------------------

    public function countPublicBySubscriber(string $subscriberCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM subscription s
                INNER JOIN channel c
                    ON s.subscriber_id = c.id
                WHERE c.code = :subscriberCode
            ")
            ->execute(["subscriberCode" => $subscriberCode])
            ->column();
        return $value;
    }

    public function yieldPublicBySubscriber(string $subscriberCode, int $offset, int $limit, ?string $channelCode): Generator
    {
        $isGuest = (!$channelCode) ? "TRUE" : "FALSE";
        $guestSubscribeType = SubscribeType::GUEST_SUBSCRIBE_NOT_ALLOWED->value;
        $selfSubscribeType = SubscribeType::SELF_SUBSCRIBE_NOT_ALLOWED->value;
        $notSubscribeType = SubscribeType::NOT_SUBSCRIBED->value;
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM subscription s
                        WHERE s.subscribed_id = c.id
                    ) as subscriber_count,
                    (
                        SELECT COUNT(*)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as video_count,
                    (
                        SELECT COALESCE(SUM(v.view_count), 0)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as view_count,
                    CASE
                        WHEN $isGuest THEN $guestSubscribeType
                        WHEN c.code = :channelCode1 THEN $selfSubscribeType
                        ELSE COALESCE(
                            (
                                SELECT s.type
                                FROM subscription s
                                INNER JOIN channel ch
                                    ON s.subscriber_id = ch.id
                                WHERE s.subscribed_id = c.id
                                  AND ch.code = :channelCode2
                                LIMIT 1
                            ),
                            $notSubscribeType
                        )
                    END AS subscribe_type,
                    CASE
                        WHEN $isGuest THEN NULL
                        WHEN c.code = :channelCode3 THEN NULL
                        ELSE (
                            SELECT s.subscribe_title
                            FROM subscription s
                            INNER JOIN channel ch
                                ON s.subscriber_id = ch.id
                            WHERE s.subscribed_id = c.id
                              AND ch.code = :channelCode4
                            LIMIT 1
                        )
                    END AS subscribe_title
                FROM channel c
                WHERE c.id IN (
                    SELECT sub.subscribed_id
                    FROM subscription sub
                    INNER JOIN channel ch
                        ON sub.subscriber_id = ch.id
                    WHERE ch.code = :subscriberCode
                )
                ORDER BY c.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute([
                "subscriberCode" => $subscriberCode,
                "channelCode1" => $channelCode,
                "channelCode2" => $channelCode,
                "channelCode3" => $channelCode,
                "channelCode4" => $channelCode,
            ])
            ->cursor(ChannelDetails::class);
    }

    // --------------------------------------------------------------------------
    // STUDIO CHANNELS
    // --------------------------------------------------------------------------

    public function countByUser(string $userCode): int
    {
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM channel c
                INNER JOIN user u
                    ON c.user_id = u.id
                WHERE u.code = :userCode
            ")
            ->execute(["userCode" => $userCode])
            ->column();
        return $value;
    }

    public function yieldByUser(string $userCode, int $offset, int $limit): Generator
    {
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM subscription s
                        WHERE s.subscribed_id = c.id
                    ) as subscriber_count,
                    (
                        SELECT COUNT(*)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as video_count,
                    (
                        SELECT COALESCE(SUM(v.view_count), 0)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as view_count
                FROM channel c
                INNER JOIN user u
                    ON c.user_id = u.id
                WHERE u.code = :userCode
                ORDER BY c.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["userCode" => $userCode])
            ->cursor(ChannelWithStats::class);
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function existsByName(string $name): bool
    {
        return $this->existsBy("name", $name);
    }

    public function findById(int $id): ?Channel
    {
        return $this->where("id", $id);
    }

    public function findByCode(string $code): ?Channel
    {
        return $this->where("code", $code);
    }

    public function findDetailsByCode(string $code, ?string $channelCode): ?ChannelDetails
    {
        $isGuest = (!$channelCode) ? "TRUE" : "FALSE";
        $guestSubscribeType = SubscribeType::GUEST_SUBSCRIBE_NOT_ALLOWED->value;
        $selfSubscribeType = SubscribeType::SELF_SUBSCRIBE_NOT_ALLOWED->value;
        $notSubscribeType = SubscribeType::NOT_SUBSCRIBED->value;
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM subscription s
                        WHERE s.subscribed_id = c.id
                    ) as subscriber_count,
                    (
                        SELECT COUNT(*)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as video_count,
                    (
                        SELECT COALESCE(SUM(v.view_count), 0)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as view_count,
                    CASE
                        WHEN $isGuest THEN $guestSubscribeType
                        WHEN c.code = :channelCode1 THEN $selfSubscribeType
                        ELSE COALESCE(
                            (
                                SELECT s.type
                                FROM subscription s
                                INNER JOIN channel ch
                                    ON s.subscriber_id = ch.id
                                WHERE s.subscribed_id = c.id
                                  AND ch.code = :channelCode2
                                LIMIT 1
                            ),
                            $notSubscribeType
                        )
                    END AS subscribe_type,
                    CASE
                        WHEN $isGuest THEN NULL
                        WHEN c.code = :channelCode3 THEN NULL
                        ELSE (
                            SELECT s.subscribe_title
                            FROM subscription s
                            INNER JOIN channel ch
                                ON s.subscriber_id = ch.id
                            WHERE s.subscribed_id = c.id
                              AND ch.code = :channelCode4
                            LIMIT 1
                        )
                    END AS subscribe_title
                FROM channel c
                WHERE c.code = :code
                LIMIT 1
            ")
            ->execute([
                "code" => $code,
                "channelCode1" => $channelCode,
                "channelCode2" => $channelCode,
                "channelCode3" => $channelCode,
                "channelCode4" => $channelCode,
            ])
            ->fetch(ChannelDetails::class);
    }

    public function findStatisticsByCode(string $code): ?ChannelWithStats
    {
        return $this->database
            ->query("
                SELECT
                    c.*,
                    (
                        SELECT COUNT(*)
                        FROM subscription s
                        WHERE s.subscribed_id = c.id
                    ) as subscriber_count,
                    (
                        SELECT COUNT(*)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as video_count,
                    (
                        SELECT COALESCE(SUM(v.view_count), 0)
                        FROM video v
                        WHERE v.uploader_id = c.id
                    ) as view_count
                FROM channel c
                WHERE c.code = :code
                LIMIT 1
            ")
            ->execute(["code" => $code])
            ->fetch(ChannelWithStats::class);
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $channel): string|false
    {
        return parent::create($channel);
    }

    public function update(int|string $code, array $channel): bool
    {
        return parent::update($code, $channel);
    }

    public function delete(int|string $code): bool
    {
        return parent::delete($code);
    }
}
