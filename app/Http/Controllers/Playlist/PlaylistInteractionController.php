<?php
// ============================================================================
// File:    PlaylistInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Playlist\Interaction\AddSchema;
use App\Http\Schemas\Playlist\Interaction\RemoveItemSchema;


#[Prefix("/playlists")]
class PlaylistInteractionController extends Controller
{
    #[Post("/{playlistCode}/add")]
    #[Schema(AddSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Add(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/remove/{order}")]
    #[Schema(RemoveItemSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function RemoveItem(IResponse $response): IResponse
    {
        return $response->html("<p>VideoPlatform</p>");
    }
}
