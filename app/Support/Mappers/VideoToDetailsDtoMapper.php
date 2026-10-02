<?php
// ============================================================================
// File:    VideoToDetailsDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\ChannelDetails;
use App\Domain\Models\VideoDetails;

use App\Support\DTOs\Video\DetailsDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class VideoToDetailsDtoMapper
{
    public function __construct(
        protected ChannelToDetailsDtoMapper $channelDetailsMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(VideoDetails $video, ChannelDetails $channel): DetailsDTO
    {
        return new DetailsDTO(
            "/videos/{$video->code}",
            $video->code,
            $video->title,
            $video->description,
            $video->thumbnail_path ? "/uploads/videos/{$video->code}/thumbnail" : DefaultImageConfig::DEFAULT_VIDEO_THUMBNAIL,
            "/uploads/videos/{$video->code}/file",
            $this->channelDetailsMapper->map($channel),
            $video->view_count,
            $this->numberHelper->formatNumber($video->view_count),
            $video->created_at,
            $this->timeHelper->timeAgo($video->created_at),
            $video->liked,
            $video->like_count,
            $this->numberHelper->formatNumber($video->like_count),
            $video->disliked,
            $video->dislike_count,
            $this->numberHelper->formatNumber($video->dislike_count),
            $video->in_watch_later,
        );
    }
}
