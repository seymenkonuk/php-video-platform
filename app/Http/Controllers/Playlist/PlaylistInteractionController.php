<?php
// ============================================================================
// File:    PlaylistInteractionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Middleware;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Middlewares\ComponentResponseMiddleware;
use App\Http\Schemas\Playlist\Interaction\AddSchema;
use App\Http\Schemas\Playlist\Interaction\RemoveItemSchema;

use App\Support\ViewProps\Components\Interaction\PlaylistCheckboxViewProp;


#[Prefix("/playlists")]
#[Authenticated]
class PlaylistInteractionController extends Controller
{
    #[Post("/{playlistCode}/add")]
    #[Schema(AddSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function Add(IRequest $request, IResponse $response): IResponse
    {
        return $response->component("/Interaction/PlaylistCheckbox", (array) new PlaylistCheckboxViewProp(
            url: "",
            data: "",
            playlist: new \App\Support\DTOs\Playlist\OptionDTO(
                url: "",
                title: "",
                videoCount: 0,
                videoCountFormatted: "0",
                viewType: \App\Domain\Enums\ViewType::PUBLIC,
                checked: true,
                itemId: null
            ),
        ));
    }

    #[Post("/{playlistCode}/remove/{order}")]
    #[Schema(RemoveItemSchema::class)]
    #[Middleware(ComponentResponseMiddleware::class)]
    public function RemoveItem(IRequest $request, IResponse $response): IResponse
    {
        return $response->component("/Interaction/PlaylistCheckbox", (array) new PlaylistCheckboxViewProp(
            url: "",
            data: "",
            playlist: new \App\Support\DTOs\Playlist\OptionDTO(
                url: "",
                title: "",
                videoCount: 0,
                videoCountFormatted: "0",
                viewType: \App\Domain\Enums\ViewType::PUBLIC,
                checked: false,
                itemId: null
            ),
        ));
    }
}
