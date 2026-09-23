<?php
// ============================================================================
// File:    ChannelToDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Support\DTOs\Channel\ChannelDTO;

use Config\DefaultImageConfig;


readonly class ChannelToDtoMapper
{
    public function map(string $code, string $title, ?string $avatar): ChannelDTO
    {
        return new ChannelDTO(
            "/channels/{$code}",
            $code,
            $title,
            $avatar ? "/uploads/channels/{$code}/avatar" : DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
        );
    }
}
