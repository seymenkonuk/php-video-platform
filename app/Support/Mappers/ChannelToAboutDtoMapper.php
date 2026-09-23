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
            new SocialLinkDTO($channel->linkedin_url ?? "", "bi-linkedin", "LinkedIn"),
            new SocialLinkDTO($channel->github_url ?? "", "bi-github", "GitHub"),
            new SocialLinkDTO($channel->instagram_url ?? "", "bi-instagram", "Instagram"),
            new SocialLinkDTO($channel->twitter_url ?? "", "bi-twitter", "Twitter"),
            new SocialLinkDTO($channel->facebook_url ?? "", "bi-facebook", "Facebook"),
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
