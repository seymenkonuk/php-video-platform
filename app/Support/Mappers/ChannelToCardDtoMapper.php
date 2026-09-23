<?php
// ============================================================================
// File:    ChannelToCardDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Enums\SubscribeType;
use App\Domain\Models\ChannelDetails;

use App\Support\DTOs\Channel\CardDTO;
use App\Support\DTOs\Channel\SubscriptionDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class ChannelToCardDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    public function map(ChannelDetails $channel): CardDTO
    {
        return new CardDTO(
            "/channels/{$channel->code}",
            $channel->title,
            $channel->avatar_path ? "/uploads/channels/{$channel->code}/avatar" : DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            new SubscriptionDTO(
                SubscribeType::from($channel->subscribe_type),
                $channel->subscribe_title,
            ),
            $channel->subscriber_count,
            $this->numberHelper->formatNumber($channel->subscriber_count),
            $channel->video_count,
            $this->numberHelper->formatNumber($channel->video_count),
        );
    }

    /**
     * @param Generator<int, ChannelDetails> $channels
     * @return Generator<int, CardDTO>
     */
    public function mapMany(Generator $channels): Generator
    {
        foreach ($channels as $channel) {
            yield $this->map($channel);
        }
    }
}
