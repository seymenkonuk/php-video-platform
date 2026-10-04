<?php
// ============================================================================
// File:    VideoToListItemDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Models\VideoWithChannel;

use App\Support\DTOs\Video\ListItemDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class VideoToListItemDtoMapper
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ChannelToDtoMapper $channelDtoMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function map(VideoWithChannel $video): ListItemDTO
    {
        return new ListItemDTO(
            null,
            "/studio/videos/{$video->code}/edit",
            $video->title,
            $video->thumbnail_path ? "/uploads/videos/{$video->code}/thumbnail" : DefaultImageConfig::DEFAULT_VIDEO_THUMBNAIL,
            $this->channelDtoMapper->map($video->channel_code, $video->channel_title, $video->channel_avatar),
            $video->duration,
            $this->timeHelper->formatTimer($video->duration),
            $video->view_count,
            $this->numberHelper->formatNumber($video->view_count),
            $video->created_at,
            $this->timeHelper->timeAgo($video->created_at),
        );
    }

    /**
     * @param Generator<int, VideoWithChannel> $videos
     * @return Generator<int, ListItemDTO>
     */
    public function mapMany(Generator $videos): Generator
    {
        foreach ($videos as $video) {
            yield $this->map($video);
        }
    }
}
