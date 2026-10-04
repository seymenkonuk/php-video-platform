<?php
// ============================================================================
// File:    MusicToDetailsDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\ChannelDetails;
use App\Domain\Models\VideoDetails;

use App\Support\DTOs\Music\DetailsDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class MusicToDetailsDtoMapper
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ChannelToDetailsDtoMapper $channelDetailsMapper,
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function map(VideoDetails $music, ChannelDetails $channel): DetailsDTO
    {
        return new DetailsDTO(
            "/musics/{$music->code}",
            $music->code,
            $music->title,
            $music->description,
            $music->thumbnail_path ? "/uploads/musics/{$music->code}/thumbnail" : DefaultImageConfig::DEFAULT_MUSIC_THUMBNAIL,
            "/uploads/musics/{$music->code}/file",
            $this->channelDetailsMapper->map($channel),
            $music->view_count,
            $this->numberHelper->formatNumber($music->view_count),
            $music->created_at,
            $this->timeHelper->timeAgo($music->created_at),
            $music->liked,
            $music->like_count,
            $this->numberHelper->formatNumber($music->like_count),
            $music->disliked,
            $music->dislike_count,
            $this->numberHelper->formatNumber($music->dislike_count),
            $music->in_watch_later,
        );
    }
}
