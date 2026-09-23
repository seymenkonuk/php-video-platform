<?php
// ============================================================================
// File:    ShortToCardDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Models\VideoWithChannel;

use App\Support\DTOs\Short\CardDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class ShortToCardDtoMapper
{
    public function __construct(
        protected ChannelToDtoMapper $channelDtoMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(VideoWithChannel $short): CardDTO
    {
        return new CardDTO(
            "/shorts/{$short->code}",
            $short->title,
            $short->thumbnail_path ? "/uploads/shorts/{$short->code}/thumbnail" : DefaultImageConfig::DEFAULT_SHORT_THUMBNAIL,
            $this->channelDtoMapper->map($short->channel_code, $short->channel_title, $short->channel_avatar),
            $short->duration,
            $this->timeHelper->formatTimer($short->duration),
            $short->view_count,
            $this->numberHelper->formatNumber($short->view_count),
            $short->created_at,
            $this->timeHelper->timeAgo($short->created_at),
        );
    }

    /**
     * @param Generator<int, VideoWithChannel> $shorts
     * @return Generator<int, CardDTO>
     */
    public function mapMany(Generator $shorts): Generator
    {
        foreach ($shorts as $short) {
            yield $this->map($short);
        }
    }
}
