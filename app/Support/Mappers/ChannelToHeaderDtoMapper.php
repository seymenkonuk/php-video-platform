<?php
// ============================================================================
// File:    ChannelToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\SubscribeType;
use App\Domain\Models\ChannelDetails;

use App\Support\DTOs\Channel\HeaderDTO;
use App\Support\DTOs\Channel\SubscriptionDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class ChannelToHeaderDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
    ) {}

    public function map(ChannelDetails $channel): HeaderDTO
    {
        return new HeaderDTO(
            "/channels/{$channel->code}",
            $channel->title,
            $channel->avatar_path ? "/uploads/channels/{$channel->code}/avatar" : DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $channel->banner_path ? "/uploads/channels/{$channel->code}/banner" : DefaultImageConfig::DEFAULT_CHANNEL_BANNER,
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
}
