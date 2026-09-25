<?php
// ============================================================================
// File:    ChannelToAboutDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\ChannelWithStats;

use App\Support\DTOs\Channel\AboutDTO;
use App\Support\DTOs\UI\SocialLinkDTO;
use App\Support\Helpers\NumberHelper;
use App\Support\Helpers\TimeHelper;


readonly class ChannelToAboutDtoMapper
{
    public function __construct(
        protected NumberHelper $numberHelper,
        protected TimeHelper $timeHelper,
    ) {}

    public function map(ChannelWithStats $channel): AboutDTO
    {
        $links = array_filter([
            new SocialLinkDTO("LinkedIn", "bi-linkedin", $channel->linkedin_url ?? ""),
            new SocialLinkDTO("GitHub", "bi-github", $channel->github_url ?? ""),
            new SocialLinkDTO("Instagram", "bi-instagram", $channel->instagram_url ?? ""),
            new SocialLinkDTO("Twitter", "bi-twitter", $channel->twitter_url ?? ""),
            new SocialLinkDTO("Facebook", "bi-facebook", $channel->facebook_url ?? ""),
        ], fn($link) => $link->url !== "");

        return new AboutDTO(
            $channel->description,
            $links,
            $channel->subscriber_count,
            $this->numberHelper->formatNumber($channel->subscriber_count),
            $channel->video_count,
            $this->numberHelper->formatNumber($channel->video_count),
            $channel->view_count,
            $this->numberHelper->formatNumber($channel->view_count),
            $channel->created_at,
            $this->timeHelper->timeAgo($channel->created_at),
        );
    }
}
