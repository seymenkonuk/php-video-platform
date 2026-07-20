<?php
// ============================================================================
// File:    PlaylistInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use App\Http\Middlewares\ComponentResponseMiddleware;

use App\Http\Schemas\Playlist\Interaction\AddSchema;
use App\Http\Schemas\Playlist\Interaction\RemoveItemSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/playlists")]
class PlaylistInteractionController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Post("/{playlistCode}/add")]
    #[Schema(AddSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Add(string $playlistCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/remove/{order}")]
    #[Schema(RemoveItemSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function RemoveItem(string $playlistCode, string $order): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
