<?php
// ============================================================================
// File:    MusicToCardDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Models\VideoWithChannel;

use App\Support\DTOs\Music\CardDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class MusicToCardDtoMapper
{
    public function __construct(
        protected ChannelToDtoMapper $channelDtoMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(VideoWithChannel $music): CardDTO
    {
        return new CardDTO(
            "/musics/{$music->code}",
            $music->title,
            $music->thumbnail_path ? "/uploads/musics/{$music->code}/thumbnail" : DefaultImageConfig::DEFAULT_MUSIC_THUMBNAIL,
            $this->channelDtoMapper->map($music->channel_code, $music->channel_title, $music->channel_avatar),
            $music->duration,
            $this->timeHelper->formatTimer($music->duration),
            $music->view_count,
            $this->numberHelper->formatNumber($music->view_count),
            $music->created_at,
            $this->timeHelper->timeAgo($music->created_at),
        );
    }

    /**
     * @param Generator<int, VideoWithChannel> $musics
     * @return Generator<int, CardDTO>
     */
    public function mapMany(Generator $musics): Generator
    {
        foreach ($musics as $music) {
            yield $this->map($music);
        }
    }
}
