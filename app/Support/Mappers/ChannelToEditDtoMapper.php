<?php
// ============================================================================
// File:    ChannelToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\Channel;

use App\Support\DTOs\Channel\EditDTO;


readonly class ChannelToEditDtoMapper
{
    public function map(Channel $channel): EditDTO
    {
        return new EditDTO(
            name: $channel->name,
            title: $channel->title,
            description: $channel->description,
            instagramUrl: $channel->instagram_url,
            twitterUrl: $channel->twitter_url,
            facebookUrl: $channel->facebook_url,
            linkedinUrl: $channel->linkedin_url,
            githubUrl: $channel->github_url,
        );
    }
}
