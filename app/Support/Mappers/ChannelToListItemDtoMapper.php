<?php
// ============================================================================
// File:    ChannelToListItemDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Models\ChannelWithStats;

use App\Support\DTOs\Channel\ListItemDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class ChannelToListItemDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    public function map(ChannelWithStats $channel): ListItemDTO
    {
        return new ListItemDTO(
            null,
            "/studio/channels/{$channel->code}",
            $channel->title,
            $channel->avatar_path ? "/uploads/channels/{$channel->code}/avatar" : DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $channel->subscriber_count,
            $this->numberHelper->formatNumber($channel->subscriber_count),
            $channel->video_count,
            $this->numberHelper->formatNumber($channel->video_count),
        );
    }

    /**
     * @param Generator<int, ChannelWithStats> $channels
     * @return Generator<int, ListItemDTO>
     */
    public function mapMany(Generator $channels): Generator
    {
        foreach ($channels as $channel) {
            yield $this->map($channel);
        }
    }
}
