<?php
// ============================================================================
// File:    PlaylistController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Playlist;


use App\Http\Schemas\Playlist\Index\IndexPageSchema;
use App\Http\Schemas\Playlist\Index\HomePageSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewModels\Playlist\IndexPageViewModel;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/playlists")]
class PlaylistController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/playlists/index", [
            "model" => new IndexPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/{playlistCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $playlistCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
