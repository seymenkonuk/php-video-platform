<?php
// ============================================================================
// File:    PlaylistInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use App\Http\Schemas\Playlist\Interaction\AddVideoSchema;
use App\Http\Schemas\Playlist\Interaction\AddShortSchema;
use App\Http\Schemas\Playlist\Interaction\AddMusicSchema;
use App\Http\Schemas\Playlist\Interaction\RemoveItemSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/playlists")]
class PlaylistInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{playlistCode}/add/video/{videoCode}")]
    #[Schema(AddVideoSchema::class)]
    public function AddVideo(string $playlistCode, string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/add/short/{shortCode}")]
    #[Schema(AddShortSchema::class)]
    public function AddShort(string $playlistCode, string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/add/music/{musicCode}")]
    #[Schema(AddMusicSchema::class)]
    public function AddMusic(string $playlistCode, string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/remove/{item}")]
    #[Schema(RemoveItemSchema::class)]
    public function RemoveItem(string $playlistCode, string $item): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
