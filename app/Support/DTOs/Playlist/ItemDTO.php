<?php
// ============================================================================
// File:    ItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\DTOs\Playlist;


use App\Domain\Enums\VideoType;

use App\Support\DTOs\Channel\ChannelDTO;
use App\Support\DTOs\Music\ListItemDTO as MusicListItemDTO;
use App\Support\DTOs\Short\ListItemDTO as ShortListItemDTO;
use App\Support\DTOs\Video\ListItemDTO as VideoListItemDTO;


readonly class ItemDTO
{
    public function __construct(
        public VideoType    $type,
        public ?int         $order,
        public string       $url,
        public string       $title,
        public string       $thumbnail,
        public ChannelDTO   $channel,
        public int          $duration,
        public string       $durationFormatted,
        public int          $viewCount,
        public string       $viewCountFormatted,
        public string       $date,
        public string       $dateFormatted,
    ) {}


    public function asVideoListItem(): VideoListItemDTO
    {
        return new VideoListItemDTO(
            order: $this->order,
            url: $this->url,
            title: $this->title,
            thumbnail: $this->thumbnail,
            channel: $this->channel,
            duration: $this->duration,
            durationFormatted: $this->durationFormatted,
            viewCount: $this->viewCount,
            viewCountFormatted: $this->viewCountFormatted,
            date: $this->date,
            dateFormatted: $this->dateFormatted,
        );
    }

    public function asShortListItem(): ShortListItemDTO
    {
        return new ShortListItemDTO(
            order: $this->order,
            url: $this->url,
            title: $this->title,
            thumbnail: $this->thumbnail,
            channel: $this->channel,
            duration: $this->duration,
            durationFormatted: $this->durationFormatted,
            viewCount: $this->viewCount,
            viewCountFormatted: $this->viewCountFormatted,
            date: $this->date,
            dateFormatted: $this->dateFormatted,
        );
    }

    public function asMusicListItem(): MusicListItemDTO
    {
        return new MusicListItemDTO(
            order: $this->order,
            url: $this->url,
            title: $this->title,
            thumbnail: $this->thumbnail,
            channel: $this->channel,
            duration: $this->duration,
            durationFormatted: $this->durationFormatted,
            viewCount: $this->viewCount,
            viewCountFormatted: $this->viewCountFormatted,
            date: $this->date,
            dateFormatted: $this->dateFormatted,
        );
    }
}
