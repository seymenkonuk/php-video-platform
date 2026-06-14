<?php
// ============================================================================
// File:    PlaylistInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/playlists")]
class PlaylistInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{playlistCode}/add/video/{videoCode}")]
    public function AddVideo(string $playlistCode, string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/add/short/{shortCode}")]
    public function AddShort(string $playlistCode, string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/add/music/{musicCode}")]
    public function AddMusic(string $playlistCode, string $musicCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/remove/{item}")]
    public function RemoveItem(string $playlistCode, string $item): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
