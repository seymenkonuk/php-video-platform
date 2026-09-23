<?php
// ============================================================================
// File:    PlaylistToCardDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use Generator;

use App\Domain\Enums\ViewType;
use App\Domain\Models\PlaylistWithChannel;

use App\Support\DTOs\Playlist\CardDTO;
use App\Support\Helpers\NumberHelper;

use Config\DefaultImageConfig;


readonly class PlaylistToCardDtoMapper
{
    public function __construct(
        protected ChannelToDtoMapper $channelDtoMapper,
        protected NumberHelper $numberHelper,
    ) {}

    public function map(PlaylistWithChannel $playlist): CardDTO
    {
        return new CardDTO(
            "/playlists/{$playlist->code}",
            $playlist->title,
            $playlist->banner_path ? "/uploads/playlists/{$playlist->code}/banner" : DefaultImageConfig::DEFAULT_PLAYLIST_BANNER,
            $this->channelDtoMapper->map($playlist->channel_code, $playlist->channel_title, $playlist->channel_avatar),
            $playlist->video_count,
            $this->numberHelper->formatNumber($playlist->video_count),
            ViewType::from($playlist->view_type),
        );
    }

    /**
     * @param Generator<int, PlaylistWithChannel> $playlists
     * @return Generator<int, CardDTO>
     */
    public function mapMany(Generator $playlists): Generator
    {
        foreach ($playlists as $playlist) {
            yield $this->map($playlist);
        }
    }
}
