<?php
// ============================================================================
// File:    ShortToDetailsDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\ChannelDetails;
use App\Domain\Models\VideoDetails;

use App\Support\DTOs\Short\DetailsDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;

use Config\DefaultImageConfig;


readonly class ShortToDetailsDtoMapper
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

    public function map(VideoDetails $short, ChannelDetails $channel): DetailsDTO
    {
        return new DetailsDTO(
            "/shorts/{$short->code}",
            $short->code,
            $short->title,
            $short->description,
            $short->thumbnail_path ? "/uploads/shorts/{$short->code}/thumbnail" : DefaultImageConfig::DEFAULT_SHORT_THUMBNAIL,
            "/uploads/shorts/{$short->code}/file",
            $this->channelDetailsMapper->map($channel),
            $short->view_count,
            $this->numberHelper->formatNumber($short->view_count),
            $short->created_at,
            $this->timeHelper->timeAgo($short->created_at),
            $short->liked,
            $short->like_count,
            $this->numberHelper->formatNumber($short->like_count),
            $short->disliked,
            $short->dislike_count,
            $this->numberHelper->formatNumber($short->dislike_count),
            $short->in_watch_later,
        );
    }
}
