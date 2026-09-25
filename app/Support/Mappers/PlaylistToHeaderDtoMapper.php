<?php
// ============================================================================
// File:    PlaylistToHeaderDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\ViewType;
use App\Domain\Models\PlaylistDetails;

use App\Support\DTOs\Playlist\HeaderDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class PlaylistToHeaderDtoMapper
{
    public function __construct(
        protected ChannelToDtoMapper $channelDtoMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(PlaylistDetails $playlist): HeaderDTO
    {
        return new HeaderDTO(
            $playlist->title,
            $playlist->description,
            $playlist->banner_path ? "/uploads/playlists/{$playlist->code}/banner" : DefaultImageConfig::DEFAULT_PLAYLIST_BANNER,
            $this->channelDtoMapper->map($playlist->channel_code, $playlist->channel_title, $playlist->channel_avatar),
            $playlist->video_count,
            $this->numberHelper->formatNumber($playlist->video_count),
            $playlist->total_duration,
            $this->timeHelper->formatDuration($playlist->total_duration),
            ViewType::from($playlist->view_type),
        );
    }
}
