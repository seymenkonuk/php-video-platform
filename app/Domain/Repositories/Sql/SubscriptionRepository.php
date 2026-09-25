<?php
// ============================================================================
// File:    SubscriptionRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\ViewType;
use App\Domain\Models\Subscription;
use App\Domain\Models\VideoWithChannel;
use App\Domain\Repositories\Abstract\ISubscriptionRepository;


/** @extends SqlRepository<Subscription> */
class SubscriptionRepository extends SqlRepository implements ISubscriptionRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "subscription";
    protected string $primaryKey = ".";
    protected string $model = Subscription::class;

    // --------------------------------------------------------------------------
    // SUBSCRIPTIONS VIDEOS
    // --------------------------------------------------------------------------

    public function countPublicBySubscriber(string $subscriberCode): int
    {
        $publicViewType = ViewType::PUBLIC->value;
        /** @var int */
        $value = $this->database
            ->query("
                SELECT COUNT(*)
                FROM video v
                WHERE v.view_type = $publicViewType
                  AND v.uploader_id IN (
                    SELECT sub.subscribed_id
                    FROM subscription sub
                    INNER JOIN channel ch
                        ON sub.subscriber_id = ch.id
                    WHERE ch.code = :subscriberCode
                  )
            ")
            ->execute(["subscriberCode" => $subscriberCode])
            ->column();
        return $value;
    }

    public function yieldPublicBySubscriber(string $subscriberCode, int $offset, int $limit): Generator
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
                WHERE v.view_type = $publicViewType
                  AND v.uploader_id IN (
                    SELECT sub.subscribed_id
                    FROM subscription sub
                    INNER JOIN channel ch
                        ON sub.subscriber_id = ch.id
                    WHERE ch.code = :subscriberCode
                  )
                ORDER BY v.created_at DESC
                LIMIT $offset, $limit
            ")
            ->execute(["subscriberCode" => $subscriberCode])
            ->cursor(VideoWithChannel::class);
    }
}
