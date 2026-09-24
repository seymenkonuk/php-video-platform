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
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // SUBSCRIBED CHANNELS
    // --------------------------------------------------------------------------

    public function countPublicBySubscriber(string $subscriberCode): int
    {
        throw new \Exception('Not implemented');
    }

    public function yieldPublicBySubscriber(string $subscriberCode, int $offset, int $limit, ?string $channelCode): Generator
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // STUDIO CHANNELS
    // --------------------------------------------------------------------------

    public function countByUser(string $userCode): int
    {
        throw new \Exception('Not implemented');
    }

    public function yieldByUser(string $userCode, int $offset, int $limit): Generator
    {
        throw new \Exception('Not implemented');
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
        throw new \Exception('Not implemented');
    }

    public function findStatisticsByCode(string $code): ?ChannelWithStats
    {
        throw new \Exception('Not implemented');
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
